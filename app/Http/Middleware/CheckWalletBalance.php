<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckWalletBalance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $wallet
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Unauthorized'], 401);
        }

        $user = auth()->user();
//        $amount = $request->input('amount');
//        $wallet = $request->input('wallet');

        $json = file_get_contents('php://input');
        $input = json_decode($json, true);

        $amount = $input['amount'];
        $wallet = $input['wallet'];


        // Parse amount dynamically - handle different formats
        $amount = $this->parseAmount($amount);

        if (!$amount || !is_numeric($amount) || $amount <= 0) {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid amount'.$amount], 400);
        }

        $balanceField = $this->getBalanceField($wallet);

        if ($amount > $user->$balanceField) {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'], 400);
        }

        // Store the wallet type in request for later use in controller
        $request->merge(['wallet_type' => $wallet]);

        return $next($request);
    }

    /**
     * Parse amount from different input formats
     *
     * @param  mixed  $amount
     * @return float|null
     */
    private function parseAmount($amount)
    {
        if (empty($amount)) {
            return null;
        }

        // If amount is already numeric, return as float
        if (is_numeric($amount)) {
            return (float) $amount;
        }

        // If amount is a string, try to extract numeric value
        if (is_string($amount)) {
            // Handle pipe-separated format: "service|amount|description"
            if (strpos($amount, '|') !== false) {
                $parts = explode('|', $amount, 3);
                if (isset($parts[1]) && is_numeric($parts[1])) {
                    return (float) $parts[1];
                }
            }

            // Handle comma-separated format: "service,amount,description"
            if (strpos($amount, ',') !== false) {
                $parts = explode(',', $amount, 3);
                if (isset($parts[1]) && is_numeric($parts[1])) {
                    return (float) $parts[1];
                }
            }

            // Try to extract numbers from the string
            if (preg_match('/\d+(\.\d+)?/', $amount, $matches)) {
                return (float) $matches[0];
            }
        }

        return null;
    }

    /**
     * Get the balance field name based on wallet type
     *
     * @param  string  $wallet
     * @return string
     */
    private function getBalanceField($wallet)
    {
        switch ($wallet) {
            case 'ref':
                return 'ref_balance';
            case 'bonus':
                return 'bonus_balance';
            default:
                return 'balance';
        }
    }
}
