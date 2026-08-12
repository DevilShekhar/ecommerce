<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('product_category_id')
                  ->nullable()
                  ->after('apply_to')
                  ->constrained('product_categories')
                  ->nullOnDelete();

            $table->foreignId('product_id')
                  ->nullable()
                  ->after('product_category_id')
                  ->constrained('products')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('product_id');
            $table->dropConstrainedForeignId('product_category_id');
        });
    }
};
