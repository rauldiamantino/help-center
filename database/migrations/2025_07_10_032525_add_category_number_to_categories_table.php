<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('category_number')->nullable()->after('id');
            $table->unique(['company_id', 'category_number'], 'unique_company_category_number');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('unique_company_category_number');
            $table->dropColumn('category_number');
        });
    }
};
