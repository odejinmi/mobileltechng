<?php

namespace App\Http\Middleware;

use Closure;

class AllowStorefront
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $general = gs();
        if ($general->store_front == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        return $next($request);
    }
}
