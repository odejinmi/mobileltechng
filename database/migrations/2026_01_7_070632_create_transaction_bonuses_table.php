<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaction_bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type'); // airtime, data, electricity, betting, cable, crypto, giftcard
            $table->decimal('bonus_percentage', 5, 2); // e.g., 1.50 for 1.5%
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Add bonus_balance to users table if it doesn't exist
        if (!Schema::hasColumn('users', 'bonus_balance')) {
            Schema::table('users', function (Blueprint $table) {
                $table->decimal('bonus_balance', 18, 8)->default(0)->after('balance');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('transaction_bonuses');

        if (Schema::hasColumn('users', 'bonus_balance')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('bonus_balance');
            });
        }
    }
};
