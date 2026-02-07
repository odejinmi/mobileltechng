<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\TransactionBonus;
use App\Models\User;

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

        $user = User::find($userId);
        $user->bonus_balance += $bonusAmount;
        $user->save();

        // Record the bonus transaction
        $transaction = new Transaction();
        $transaction->user_id = $userId;
        $transaction->amount = $bonusAmount;
        $transaction->post_balance = $user->bonus_balance;
        $transaction->trx_type = '+';
        $transaction->details = 'Bonus for ' . $transactionType . ' transaction';
        $transaction->trx = getTrx();
        $transaction->remark = 'bonus_' . $transactionType;
        $transaction->save();

        return $bonusAmount;
    }

    public static function debitaccount($user,$amount,$wallet){
        if($wallet == 'ref')
        {
            if($amount > $user->ref_balance)
            {
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
            }else{
                $user->ref_balance -= $amount;
                $user->save();
            }
        }
        else if($wallet == 'bonus')
        {
            if($amount > $user->bonus_balance)
            {
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
            }else{
                $user->bonus_balance -= $amount;
                $user->save();
            }
        }
        else
        {
            if($amount > $user->balance)
            {
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
            }else{
                $user->balance -= $amount;
                $user->save();
            }
        }
    }
    public static function refundaccount($user,$amount,$wallet){
        if($wallet == 'ref')
        {
                $user->ref_balance += $amount;
                $user->save();
        }
        else if($wallet == 'bonus')
        {
                $user->bonus_balance += $amount;
                $user->save();
        }
        else
        {
                $user->balance += $amount;
                $user->save();

        }
    }
}
