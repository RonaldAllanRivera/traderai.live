<?php

namespace App\Http\Middleware;

use App\Models\CloakRule;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CloakerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Optional toggle via config/app.php => 'cloaking_enabled' or .env CLOAKING_ENABLED
        if (! (bool) config('app.cloaking_enabled', true)) {
            return $next($request);
        }

        // Never cloak admin / Filament
        if ($request->is('admin*')) {
            return $next($request);
        }

        $ua = $request->userAgent() ?: '';
        $ref = $request->headers->get('referer', '');
        $ip = $request->ip();
        $country = strtoupper($request->headers->get('CF-IPCountry', $request->query('__country', '')));
        $query = $request->query();

        // Local/test overrides for convenience when opened from admin tester links
        $allowOverrides = app()->environment('local') || (bool) config('app.cloaker_test_overrides', true);
        if ($allowOverrides) {
            if ($request->filled('__ua')) {
                $ua = (string) $request->query('__ua');
            }
            if ($request->filled('__ref')) {
                $ref = (string) $request->query('__ref');
            }
        }

        $rules = CloakRule::query()
            ->where('status', 'active')
            ->orderBy('id')
            ->get();

        foreach ($rules as $rule) {
            $patterns = preg_split('/[\r\n,]+/', (string) $rule->pattern, -1, PREG_SPLIT_NO_EMPTY);
            $matched = false;

            foreach ($patterns as $pattern) {
                $p = trim($pattern);
                if ($p === '') {
                    continue;
                }

                switch ($rule->match_type) {
                    case 'ip':
                        $matched = ($ip === $p);
                        break;
                    case 'country':
                        $matched = ($country !== '' && strtoupper($p) === $country);
                        break;
                    case 'ua':
                        $matched = (stripos($ua, $p) !== false);
                        break;
                    case 'referrer':
                        $matched = ($ref !== '' && stripos($ref, $p) !== false);
                        break;
                    case 'param':
                        if (str_contains($p, '=')) {
                            [$k, $v] = array_map('trim', explode('=', $p, 2));
                            $matched = isset($query[$k]) && strcasecmp((string) $query[$k], $v) === 0;
                        } else {
                            // fallback: substring in full URL
                            $matched = (stripos($request->fullUrl(), $p) !== false);
                        }
                        break;
                    default:
                        $matched = false;
                }

                if ($matched) {
                    break;
                }
            }

            // Decision logic applies ONLY when a rule MATCHES
            // whitelist => matched goes to offer; blacklist => matched goes to safe

            $safeUrl = $rule->safe_url ?: (route('safe'));
            $offerUrl = $rule->offer_url ?: (route('home'));

            // Preserve testing/marketing query params on redirect (so __country/utm reach the view)
            $preserveKeys = ['__country','geo','geo_debug','__ua','__ref','utm_source','utm_medium','utm_campaign','utm_term','utm_content','gclid','fbclid'];
            $preserve = array_intersect_key($query, array_flip($preserveKeys));
            if (!empty($preserve)) {
                $safeUrl = $this->appendQueryParams($safeUrl, $preserve);
                $offerUrl = $this->appendQueryParams($offerUrl, $preserve);
            }

            // Normalize current request URI (path + query) and destination URIs to avoid redirect loops
            $currentUri = $request->getRequestUri(); // includes path + query, e.g. "/?utm=..."
            $normalize = function (string $url): string {
                $path = parse_url($url, PHP_URL_PATH) ?: '/';
                $query = parse_url($url, PHP_URL_QUERY);
                return $path . ($query ? ('?' . $query) : '');
            };
            $safeDest = $normalize($safeUrl);
            $offerDest = $normalize($offerUrl);

            // Only act when the rule MATCHES; otherwise continue to next rule
            if ($matched) {
                $goOffer = ($rule->mode === 'whitelist');

                if ($goOffer) {
                    // Avoid redirect loop if destination equals current URL
                    if ($offerDest !== $currentUri) {
                        $rule->increment('hits_offer');
                        return redirect()->to($offerUrl);
                    }
                    // Already on destination, let the request proceed without redirect
                    return $next($request);
                }

                if ($safeDest !== $currentUri) {
                    $rule->increment('hits_safe');
                    return redirect()->to($safeUrl);
                }
                return $next($request);
            }
        }

        return $next($request);
    }

    /**
     * Append/merge the given query params to the target URL.
     */
    private function appendQueryParams(string $url, array $params): string
    {
        if (empty($params)) {
            return $url;
        }
        $base = preg_replace('/\?.*$/', '', $url);
        $existingQuery = parse_url($url, PHP_URL_QUERY);
        $existing = [];
        if ($existingQuery) {
            parse_str($existingQuery, $existing);
        }
        $merged = array_merge($existing, $params);
        $qs = http_build_query($merged);
        return $base . ($qs ? ('?' . $qs) : '');
    }
}
