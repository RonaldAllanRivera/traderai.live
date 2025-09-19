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

        // 3) Session cache
        if (!$iso) {
            $iso = session('resolved_iso');
            $dial = session('resolved_dial');
        }

        // 4) Remote lookup as a last resort (fast timeout, swallow errors)
        if (!$iso) {
            try {
                $ctx = stream_context_create([
                    'http' => [
                        'method' => 'GET',
                        'timeout' => 0.7, // 700ms hard cap
                        'header' => "Accept: application/json\r\nUser-Agent: TraderAI/1.0\r\n",
                    ],
                ]);
                $json = @file_get_contents('https://ipwho.is/?fields=country_code,calling_code', false, $ctx);
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
        if ($iso) {
            session(['resolved_iso' => $iso]);
        }
        if ($dial) {
            session(['resolved_dial' => $dial]);
        }

        // Attach to request for views/controllers
        if ($iso) { $request->attributes->set('resolved_iso', $iso); }
        if ($dial) { $request->attributes->set('resolved_dial', $dial); }

        return $next($request);
    }
}
