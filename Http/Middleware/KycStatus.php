<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class KycStatus
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
        $user = auth()->user();
        if ($user->kyc_complete != 1) {
            $notify[] = ['error', 'Please complete your KYC before proceding'];
            return back()->withNotify($notify);
        }
        return $next($request);
    }
}
