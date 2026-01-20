<?php

namespace Database\Seeders;

use App\Models\TransactionBonus;
use Illuminate\Database\Seeder;

class TransactionBonusSeeder extends Seeder
{
    public function run()
    {
        $bonuses = [
            ['transaction_type' => 'airtime', 'bonus_percentage' => 1.0, 'is_active' => true],
            ['transaction_type' => 'data', 'bonus_percentage' => 1.5, 'is_active' => true],
            ['transaction_type' => 'electricity', 'bonus_percentage' => 0.5, 'is_active' => true],
            ['transaction_type' => 'betting', 'bonus_percentage' => 2.0, 'is_active' => true],
            ['transaction_type' => 'cable', 'bonus_percentage' => 0.75, 'is_active' => true],
            ['transaction_type' => 'crypto', 'bonus_percentage' => 1.25, 'is_active' => true],
            ['transaction_type' => 'giftcard', 'bonus_percentage' => 1.75, 'is_active' => true],
        ];

        foreach ($bonuses as $bonus) {
            TransactionBonus::updateOrCreate(
                ['transaction_type' => $bonus['transaction_type']],
                $bonus
            );
        }
    }
}
