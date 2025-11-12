<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogApiRequests
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Log API request
        Log::channel('api')->info('API Request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'status' => $response->status(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => $request->user() ? $request->user()->id : null,
            'response_time' => microtime(true) - LARAVEL_START,
        ]);

        return $response;
    }
}
