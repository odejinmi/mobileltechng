<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $amount = (float) $amount;

        if ($amount <= 0) {
            return false;
        }

        return DB::transaction(function () use ($user, $amount, $balanceField) {
            $lockedUser = User::query()->whereKey($user->id)->lockForUpdate()->first();
            if (!$lockedUser) {
                return false;
            }

            $balanceBefore = (float) $lockedUser->$balanceField;
            if ($amount > $balanceBefore) {
                return false;
            }

            $lockedUser->$balanceField = $balanceBefore - $amount;
            $lockedUser->save();

            $user->$balanceField = $lockedUser->$balanceField;
            return true;
        });
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
        $amount = (float) $amount;

        if ($amount <= 0) {
            return;
        }

        DB::transaction(function () use ($user, $amount, $balanceField) {
            $lockedUser = User::query()->whereKey($user->id)->lockForUpdate()->first();
            if (!$lockedUser) {
                return;
            }

            $lockedUser->$balanceField = (float) $lockedUser->$balanceField + $amount;
            $lockedUser->save();

            $user->$balanceField = $lockedUser->$balanceField;
        });
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
            case 'ref_balance':
            case 'referral':
                return 'ref_balance';
            case 'bonus':
            case 'bonus_balance':
                return 'bonus_balance';
            case 'main':
            case 'balance':
            case 'main_balance':
            default:
                return 'balance';
        }
    }

    public static function debitWithLock($userId, $amount, $wallet = 'balance')
    {
        $balanceField = self::getBalanceField($wallet);
        $amount = (float) $amount;

        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than 0');
        }

        return DB::transaction(function () use ($userId, $amount, $balanceField) {
            $lockedUser = User::query()->whereKey($userId)->lockForUpdate()->firstOrFail();
            $balanceBefore = (float) $lockedUser->$balanceField;

            if ($amount > $balanceBefore) {
                throw new \RuntimeException('INSUFFICIENT_BALANCE');
            }

            $lockedUser->$balanceField = $balanceBefore - $amount;
            $lockedUser->save();

            return [
                'user' => $lockedUser,
                'balance_before' => $balanceBefore,
                'balance_after' => (float) $lockedUser->$balanceField,
                'balance_field' => $balanceField,
            ];
        });
    }

    public static function creditWithLock($userId, $amount, $wallet = 'balance')
    {
        $balanceField = self::getBalanceField($wallet);
        $amount = (float) $amount;

        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than 0');
        }

        return DB::transaction(function () use ($userId, $amount, $balanceField) {
            $lockedUser = User::query()->whereKey($userId)->lockForUpdate()->firstOrFail();
            $balanceBefore = (float) $lockedUser->$balanceField;

            $lockedUser->$balanceField = $balanceBefore + $amount;
            $lockedUser->save();

            return [
                'user' => $lockedUser,
                'balance_before' => $balanceBefore,
                'balance_after' => (float) $lockedUser->$balanceField,
                'balance_field' => $balanceField,
            ];
        });
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
