<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetCspHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Check if the current route is an admin route
        $isAdminRoute = $this->isAdminRoute($request);
        
        if ($isAdminRoute) {
            // Admin CSP: includes 'unsafe-eval' for Livewire/Alpine.js
            $csp = "default-src 'self'; " .
                   "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com https://*.livecoinwatch.com https://cdnjs.cloudflare.com https://snap.licdn.com; " .
                   "style-src 'self' 'unsafe-inline' data: https://cdnjs.cloudflare.com; " .
                   "img-src 'self' data: blob: https:; " .
                   "font-src 'self' data:; " .
                   "connect-src 'self' https://*.livecoinwatch.com https://px.ads.linkedin.com https://challenges.cloudflare.com; " .
                   "frame-src 'self' https://challenges.cloudflare.com; " .
                   "media-src 'self' data: blob:; " .
                   "worker-src 'self' blob:; " .
                   "frame-ancestors 'self'; " .
                   "object-src 'none'; " .
                   "base-uri 'self'; " .
                   "form-action 'self'";
        } else {
            // Public CSP: stricter (no unsafe-eval)
            $csp = "default-src 'self'; " .
                   "script-src 'self' 'unsafe-inline' https://challenges.cloudflare.com https://*.livecoinwatch.com https://cdnjs.cloudflare.com https://snap.licdn.com; " .
                   "style-src 'self' 'unsafe-inline' data: https://cdnjs.cloudflare.com; " .
                   "img-src 'self' data: blob: https:; " .
                   "font-src 'self' data:; " .
                   "connect-src 'self' https://*.livecoinwatch.com https://px.ads.linkedin.com https://challenges.cloudflare.com; " .
                   "frame-src 'self' https://challenges.cloudflare.com; " .
                   "media-src 'self' data: blob:; " .
                   "worker-src 'self' blob:; " .
                   "frame-ancestors 'self'; " .
                   "object-src 'none'; " .
                   "base-uri 'self'; " .
                   "form-action 'self'";
        }
        
        $response->headers->set('Content-Security-Policy', $csp);
        
        return $response;
    }
    
    /**
     * Check if the current request is for an admin route.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function isAdminRoute(Request $request): bool
    {
        // Prefer route-name detection for Filament Admin panel routes
        // Filament (v4) panel with id 'admin' uses route names like 'filament.admin.*'
        if ($request->routeIs('filament.admin.*')) {
            return true;
        }

        // Fallback to path-prefix detection
        $uri = $request->path();
        return str_starts_with($uri, 'admin');
    }
}
