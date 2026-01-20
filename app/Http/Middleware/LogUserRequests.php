<?php
// app/Http/Middleware/LogUserRequests.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogUserRequests
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Log API request
        Log::info('User Request', [
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
