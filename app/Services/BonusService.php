<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\TransactionBonus;
use App\Models\User;
use App\Services\WalletService;

class BonusService
{
    public static function processBonus($userId, $transactionType, $amount, $transactionId)
    {
        $bonusPercentage = TransactionBonus::getBonusPercentage($transactionType);
        $bonusAmount = TransactionBonus::getBonusAmount($transactionType);
        $bonustype = TransactionBonus::getBonusType($transactionType);

        \Log::info("Bonus of {$bonustype} awarded for airtime purchase");
        if (!$bonustype) {
            if ($bonusPercentage <= 0) {
                return null;
            }

            $bonusAmount = ($amount * $bonusPercentage) / 100;
        }

        $credit = WalletService::creditWithLock($userId, $bonusAmount, 'bonus');
        $user = $credit['user'];

        // Record the bonus transaction
        $transaction = new Transaction();
        $transaction->user_id = $userId;
        $transaction->amount = $bonusAmount;
        $transaction->post_balance = $credit['balance_after'];
        $transaction->trx_type = '+';
        $transaction->details = 'Bonus for ' . $transactionType . ' transaction';
        $transaction->trx = getTrx();
        $transaction->remark = 'bonus_' . $transactionType;
        $transaction->save();

        return $bonusAmount;
    }

    public static function debitaccount($user,$amount,$wallet){
        try {
            WalletService::debitWithLock($user->id, $amount, $wallet);
        } catch (\RuntimeException $e) {
            if ($e->getMessage() === 'INSUFFICIENT_BALANCE') {
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
            }
            throw $e;
        }
    }
    public static function refundaccount($user,$amount,$wallet){
        WalletService::creditWithLock($user->id, $amount, $wallet);
    }
}
