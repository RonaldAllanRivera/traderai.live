<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ResolveCountryMiddleware
{
    /**
     * Try to resolve visitor country ISO2 and dial code server-side.
     * Priority:
     * 1) Explicit overrides: __country or geo query param
     * 2) Proxy headers (e.g., Cloudflare CF-IPCountry)
     * 3) Cached session value from previous resolution
     * 4) Lightweight remote lookup (ipwho.is) with short timeout
     */
    public function handle(Request $request, Closure $next)
    {
        $iso = null;
        $dial = null;

        // 1) Explicit overrides win
        $override = $request->query('__country') ?: $request->query('geo');
        if ($override) {
            $iso = strtoupper((string) $override);
        }

        // 2) Proxy/CDN headers
        if (!$iso) {
            $hdrs = [
                'CF-IPCountry',            // Cloudflare
                'X-AppEngine-Country',     // App Engine / some proxies
                'X-Country-Code',
                'X-Geo-Country',
            ];
            foreach ($hdrs as $h) {
                $val = $request->headers->get($h);
                if ($val) { $iso = strtoupper((string) $val); break; }
            }
        }

        // 3) Session cache with short TTL (60s)
        if (!$iso) {
            $ttl = 60; // seconds
            $ts = (int) session('resolved_geo_ts', 0);
            if ($ts && (time() - $ts) <= $ttl) {
                $iso = session('resolved_iso');
                $dial = session('resolved_dial');
            } else {
                // stale or empty: clear
                session()->forget(['resolved_geo_ts', 'resolved_iso', 'resolved_dial']);
            }
        }

        // 4) Remote lookup as a last resort (fast timeout, swallow errors)
        if (!$iso) {
            try {
                // Try to resolve the real client IP (behind proxies/CDN)
                $clientIp = $request->headers->get('CF-Connecting-IP')
                    ?: $request->headers->get('True-Client-IP');
                if (!$clientIp) {
                    $xff = $request->headers->get('X-Forwarded-For');
                    if ($xff) {
                        $parts = explode(',', $xff);
                        $clientIp = trim($parts[0] ?? '');
                    }
                }
                if (!$clientIp) {
                    $clientIp = $request->headers->get('X-Real-IP');
                }
                if (!$clientIp) {
                    $clientIp = $request->ip();
                }

                $ctx = stream_context_create([
                    'http' => [
                        'method' => 'GET',
                        'timeout' => 0.7, // 700ms hard cap
                        'header' => "Accept: application/json\r\nUser-Agent: TraderAI/1.0\r\n",
                    ],
                ]);
                $url = 'https://ipwho.is/' . rawurlencode((string) $clientIp) . '?fields=country_code,calling_code';
                $json = @file_get_contents($url, false, $ctx);
                if ($json) {
                    $data = @json_decode($json, true);
                    if (!empty($data['country_code'])) {
                        $iso = strtoupper((string) $data['country_code']);
                    }
                    if (!empty($data['calling_code'])) {
                        $dial = (string) $data['calling_code'];
                    }
                }
            } catch (\Throwable $e) {
                // ignore
            }
        }

        // Store in session for reuse
        if ($iso) { session(['resolved_iso' => $iso]); }
        if ($dial) { session(['resolved_dial' => $dial]); }
        if ($iso || $dial) { session(['resolved_geo_ts' => time()]); }

        // Attach to request for views/controllers
        if ($iso) { $request->attributes->set('resolved_iso', $iso); }
        if ($dial) { $request->attributes->set('resolved_dial', $dial); }

        // Continue the request and set response headers to avoid cross-country cache bleed
        $response = $next($request);
        // Ensure CDN varies cache by country when header is present
        if ($request->headers->has('CF-IPCountry')) {
            $existing = $response->headers->get('Vary');
            $vary = array_filter(array_map('trim', array_unique(array_merge(
                $existing ? explode(',', $existing) : [],
                ['CF-IPCountry']
            ))));
            if (!empty($vary)) {
                $response->headers->set('Vary', implode(', ', $vary));
            }
        }
        return $response;
    }
}
