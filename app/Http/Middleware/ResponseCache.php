<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponseCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add cache headers for static assets
        if ($request->is('storage/*') || $request->is('*.css') || $request->is('*.js') || $request->is('*.jpg') || $request->is('*.jpeg') || $request->is('*.png') || $request->is('*.gif') || $request->is('*.svg') || $request->is('*.webp')) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
        }

        // Add compression headers
        if ($response->headers->has('Content-Type')) {
            $contentType = $response->headers->get('Content-Type');
            
            if (str_contains($contentType, 'text/html') || 
                str_contains($contentType, 'text/css') || 
                str_contains($contentType, 'application/javascript') ||
                str_contains($contentType, 'application/json')) {
                // Enable compression via .htaccess or Nginx config
                $response->headers->set('Vary', 'Accept-Encoding');
            }
        }

        return $response;
    }
}

