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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_category')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');

            // General Information
            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->text('variants')->nullable();
            $table->longText('specification')->nullable();
            $table->longText('image')->nullable(); // Comma-separated paths for multiple images
            
            // Flags and Status
            // 0 = Normal Product, 1 = Featured Product, 2 = New Product
            $table->tinyInteger('is_futured')->default(0); 
            // 1 = Active, 0 = Inactive
            $table->tinyInteger('status')->default(1); 

            // SEO Meta Information
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable(); // UI label: Meta Description / Meta Ads

            // User Audit Tracking
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};