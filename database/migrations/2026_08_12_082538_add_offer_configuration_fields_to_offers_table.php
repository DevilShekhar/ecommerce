<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {

            $table->enum('apply_to', ['category', 'product'])
                ->after('description');

            $table->enum('discount_type', ['percentage', 'fixed'])
                ->after('apply_to');

            $table->decimal('discount_value', 10, 2)
                ->default(0)
                ->after('discount_type');

            $table->date('start_date')
                ->nullable()
                ->after('discount_value');

            $table->date('end_date')
                ->nullable()
                ->after('start_date');
        });
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {

            $table->dropColumn([
                'apply_to',
                'discount_type',
                'discount_value',
                'start_date',
                'end_date',
            ]);

        });
    }
};
