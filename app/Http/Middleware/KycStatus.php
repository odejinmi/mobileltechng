<?php

namespace App\Http\Middleware;

use App\Models\Transaction;
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
        $transaction = Transaction::where('user_id', $user->id)
            ->where(function($query) {
                $query->where('remark', 'LIKE', '%funding%')
                    ->orWhere('remark', 'LIKE', '%deposit%');
            })
            ->first();

        if ($user->kyc_complete != 1) {
            $notify[] = ['error', 'Please complete your KYC before proceding'];
            return back()->withNotify($notify);
        }
        if (!isset($transaction)) {
            $notify[] = ['error', 'Please Fund your account before proceding'];
            return back()->withNotify($notify);
        }
        return $next($request);
    }
}
