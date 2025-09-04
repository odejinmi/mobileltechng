<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model {
    use GlobalStatus;

    public function escrow() {
        return $this->belongsTo(Escrow::class);
    }

    public function deposit() {
        return $this->hasOne(Deposit::class);
    }

    public function scopeUnFunded($query) {
        return $query->where('payment_status', Status::MILESTONE_UNFUNDED);
    }
    public function scopeFunded($query) {
        return $query->where('payment_status', Status::MILESTONE_FUNDED);
    }

    public function scopeMakePaid($filter, $mile_id, $user) {
        $milestone = $this->where('payment_status', Status::MILESTONE_UNFUNDED)->where('status', Status::NO)->whereHas('escrow', function ($query) {
            $query->where('status', '!=', Status::ESCROW_DISPUTED)->where('status', '!=', Status::ESCROW_CANCELLED);
        })->find($mile_id);

        if ($milestone) {
            $user->balance -= $milestone->amount;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $milestone->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Milestone paid for ' . $milestone->escrow->title;
            $transaction->trx          = getTrx();
            $transaction->save();

            $milestone->payment_status = Status::MILESTONE_FUNDED;
            $milestone->status         = Status::YES;
            $milestone->save();

            $escrow = $milestone->escrow;
            $escrow->paid_amount += $milestone->amount;
            $escrow->save();
        }
    }
}
