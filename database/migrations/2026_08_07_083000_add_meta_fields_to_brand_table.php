<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete()
                ->after('status');

            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained('sub_category')
                ->nullOnDelete()
                ->after('category_id');
            $table->string('meta_title')->nullable()->after('status');
            $table->text('meta_ads')->nullable()->after('meta_title');
            $table->text('meta_keyword')->nullable()->after('meta_ads');
            $table->unsignedBigInteger('created_by')->nullable()->after('meta_keyword');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('sub_category_id');
            $table->dropColumn([
                'meta_title',
                'meta_ads',
                'meta_keyword',
                'created_by',
                'updated_by',
            ]);
        });
    }
};
