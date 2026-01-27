<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVisitorRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Define routes that should be accessible without registration
        $excludedRoutes = [
            'welcome',
            'visitor.register',
            'visitor.store',
        ];

        if ($request->routeIs($excludedRoutes)) {
            // If visitor is already registered and tries to access welcome page, redirect to home
            if ($request->hasCookie('visitor_registered') && $request->routeIs('welcome')) {
                return redirect()->route('home');
            }
            return $next($request);
        }

        if (!$request->hasCookie('visitor_registered')) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
