<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_number')->nullable()->after('id')->change();
            $table->unique(['company_id', 'user_number'], 'unique_company_user_number');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('unique_company_user_number');
            $table->integer('user_number')->change();
        });
    }
};
