<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('UPDATE credit_cards SET nickname = name_on_card WHERE nickname IS NULL');

        Schema::table('credit_cards', function (Blueprint $table) {
            $table->renameColumn('nickname', 'name');
        });

        Schema::table('credit_cards', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('credit_cards', function (Blueprint $table) {
            $table->string('nickname')->nullable()->change();
        });

        Schema::table('credit_cards', function (Blueprint $table) {
            $table->renameColumn('name', 'nickname');
        });
    }
};
