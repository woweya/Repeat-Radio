<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CacheRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Generate a unique cache key based on the full URL of the request
        $key = 'routes-' . md5($request->fullUrl());

        // Check if there is already a cached response for the current URL
        if (Cache::has($key)) {
            // If a response is already present in the cache, return it directly
            return Cache::get($key);
        }

        // Pass the request to the next middleware for processing
        $response = $next($request);

        // Cache the response for a specified period of time (30 minutes)
        Cache::put($key, $response, now()->addMinutes(30));

         // Return the response processed by the next middleware
        return $response;
    }

}
