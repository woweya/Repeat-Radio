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
        $key = 'routes-' . md5($request->fullUrl());
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $response = $next($request);
        Cache::put($key, $response, now()->addMinutes(30));
        return $response;
    }

}
