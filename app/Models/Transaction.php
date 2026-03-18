<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Searchable;
    protected $casts = [ 
        'val_1' => 'object'
    ];

    protected static function booted()
    {
        static::creating(function (Transaction $transaction) {
            if ($transaction->balance_after === null && $transaction->post_balance !== null) {
                $transaction->balance_after = $transaction->post_balance;
            }

            if ($transaction->balance_before === null && $transaction->balance_after !== null && $transaction->amount !== null && $transaction->trx_type !== null) {
                $amount = (float) $transaction->amount;
                $charge = $transaction->charge !== null ? (float) $transaction->charge : 0.0;
                $after = (float) $transaction->balance_after;

                if ($transaction->trx_type === '+') {
                    $transaction->balance_before = $after - $amount;
                } elseif ($transaction->trx_type === '-') {
                    $transaction->balance_before = $after + $amount + $charge;
                }
            }
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'val_1');
    }

}
