<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AllowVendor
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		$user = auth()->user();
		 
		if ($user->vendor != 1) {
			$notify[] = ['error', 'You are not a vendor. Contact admin for updgrade'];
            return back()->withNotify($notify);
		}
		return $next($request);
	}
}