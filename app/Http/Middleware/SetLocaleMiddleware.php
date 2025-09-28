<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if a language is stored in the session
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            // Set a default locale (optional)
            $locale = $request->getPreferredLanguage(['fr', 'ar']);
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }

        return $next($request);
    }
}