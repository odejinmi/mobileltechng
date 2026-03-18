<?php

namespace App\Http\Middleware;

use App\Constants\Status;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BanNewUsersLargeTransactions
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$user->created_at) {
            return $next($request);
        }

        $accountAgeDays = Carbon::parse($user->created_at)->diffInDays(Carbon::now());
        if ($accountAgeDays >= 60) {
            return $next($request);
        }

        $amount = $this->extractAmount($request);
        if ($amount === null || $amount <= 5000) {
            return $next($request);
        }

        $user->status = Status::USER_BAN;
        $user->save();

        Auth::logout();
        $request->session()->invalidate();

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Account banned: new users cannot transact above 5000'
            ], 403);
        }

        return redirect()->route('user.login')->withNotify([
            ['error', 'Account banned: new users cannot transact above 5000']
        ]);
    }

    private function extractAmount(Request $request): ?float
    {
        $amountCandidates = [];

        if ($request->has('amount')) {
            $amountCandidates[] = $request->input('amount');
        }
        if ($request->has('plan')) {
            $amountCandidates[] = $request->input('plan');
        }
        if ($request->has('payment')) {
            $amountCandidates[] = $request->input('payment');
        }

        $rawBody = $request->getContent();
        if ($rawBody) {
            $decoded = json_decode($rawBody, true);
            if (is_array($decoded)) {
                foreach (['amount', 'plan', 'payment', 'total'] as $key) {
                    if (array_key_exists($key, $decoded)) {
                        $amountCandidates[] = $decoded[$key];
                    }
                }
            }
        }

        foreach ($amountCandidates as $candidate) {
            $parsed = $this->parseAmount($candidate);
            if ($parsed !== null) {
                return $parsed;
            }
        }

        return null;
    }

    private function parseAmount($amount): ?float
    {
        if ($amount === null || $amount === '') {
            return null;
        }

        if (is_numeric($amount)) {
            return (float) $amount;
        }

        if (!is_string($amount)) {
            return null;
        }

        if (str_contains($amount, '|')) {
            $parts = explode('|', $amount, 3);
            if (isset($parts[1]) && is_numeric($parts[1])) {
                return (float) $parts[1];
            }
        }

        if (str_contains($amount, ',')) {
            $parts = explode(',', $amount, 3);
            if (isset($parts[1]) && is_numeric($parts[1])) {
                return (float) $parts[1];
            }
        }

        if (preg_match('/\d+(\.\d+)?/', $amount, $matches)) {
            return (float) $matches[0];
        }

        return null;
    }
}

