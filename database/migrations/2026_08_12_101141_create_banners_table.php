<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            // Banner basic details
            $table->string('title')->nullable();

            $table->enum('banner_type', [
                'homepage_slider',
                'promotional',
                'category',
                'festival',
                'popup',
                'mobile',
            ]);
            $table->string('image');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete();
            $table->enum('link_type', [
                'none',
                'custom_url',
                'product',
                'category',
            ])->default('none');
            $table->text('link_value')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
