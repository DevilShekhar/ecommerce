<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->nullOnDelete();
            $table->string('code', 100)->unique();
            $table->enum('discount_type', ['percentage', 'flat']);
            $table->decimal('discount_value', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('usage_limit')->nullable();
            $table->unsignedInteger('used_count')->default(0);
            $table->decimal('minimum_order_amount', 10, 2)->default(0);
            $table->decimal('maximum_discount', 10, 2)->nullable();
            $table->boolean('status')->default(1);
             $table->string('meta_title')->nullable();
            $table->text('meta_ads')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
