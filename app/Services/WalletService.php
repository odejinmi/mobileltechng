<?php

namespace App\Services;

use App\Models\User;

class WalletService
{
    /**
     * Debit amount from user's wallet
     *
     * @param  User  $user
     * @param  float  $amount
     * @param  string  $wallet
     * @return bool
     */
    public static function debitAccount(User $user, $amount, $wallet = 'balance')
    {
        $balanceField = self::getBalanceField($wallet);
        
        if ($amount > $user->$balanceField) {
            return false;
        }

        $user->$balanceField -= $amount;
        $user->save();

        return true;
    }

    /**
     * Credit amount to user's wallet
     *
     * @param  User  $user
     * @param  float  $amount
     * @param  string  $wallet
     * @return void
     */
    public static function creditAccount(User $user, $amount, $wallet = 'balance')
    {
        $balanceField = self::getBalanceField($wallet);
        $user->$balanceField += $amount;
        $user->save();
    }

    /**
     * Get the balance field name based on wallet type
     *
     * @param  string  $wallet
     * @return string
     */
    private static function getBalanceField($wallet)
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

    /**
     * Get user's wallet balance
     *
     * @param  User  $user
     * @param  string  $wallet
     * @return float
     */
    public static function getBalance(User $user, $wallet = 'balance')
    {
        $balanceField = self::getBalanceField($wallet);
        return $user->$balanceField;
    }
}
