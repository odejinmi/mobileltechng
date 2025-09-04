<?php

namespace App\Http\Middleware;

use Closure;

class AllowSellCrypto
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
        if ($general->sell_crypto == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        return $next($request);
    }
}
