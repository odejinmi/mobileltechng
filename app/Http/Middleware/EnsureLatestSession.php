<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureLatestSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $expected = $user->current_session_id;

        if (!$expected) {
            return $next($request);
        }

        $headerToken = $request->header('X-Device-Session');
        $sessionToken = $request->session()->get('current_session_id');
        $incoming = $headerToken ?: $sessionToken;

        if ($incoming && hash_equals($expected, $incoming)) {
            return $next($request);
        }

        Auth::logout();
        $request->session()->invalidate();

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Your session is no longer active on this device. Please login again.'
            ], 401);
        }

        return redirect()->route('user.login')->withNotify([
            ['error', 'Your session is no longer active on this device. Please login again.']
        ]);
    }
}

