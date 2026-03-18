<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('users', 'current_session_id')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('current_session_id', 100)->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('users', 'current_session_id')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('current_session_id');
        });
    }
};
