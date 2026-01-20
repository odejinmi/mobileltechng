<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionBonus extends Model
{
    protected $fillable = [
        'transaction_type',
        'bonus_percentage',
        'is_active'
    ];

    protected $casts = [
        'bonus_percentage' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public static function getBonusPercentage($transactionType)
    {
        $bonus = self::where('transaction_type', $transactionType)
            ->where('is_active', true)
            ->first();

        return $bonus ? $bonus->bonus_percentage : 0;
    }
    public static function getBonusAmount($transactionType)
    {
        $bonus = self::where('transaction_type', $transactionType)
            ->where('is_active', true)
            ->first();

        return $bonus ? $bonus->bonus_amount : 0;
    }
    public static function getBonusType($transactionType)
    {
        $bonus = self::where('transaction_type', $transactionType)
            ->where('is_active', true)
            ->first();

        return $bonus ? $bonus->bonus_type : false;
    }
}
