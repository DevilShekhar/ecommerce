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
    Schema::create('page_sections', function (Blueprint $table) {
        $table->id();

        $table->foreignId('page_id')
            ->constrained('pages')
            ->cascadeOnDelete();

        $table->string('section_type');

        $table->string('title')->nullable();
        $table->string('sub_title')->nullable();

        $table->longText('content')->nullable();

        $table->string('image')->nullable();

        $table->string('button_text')->nullable();
        $table->string('button_url')->nullable();

        $table->json('settings')->nullable();

        $table->integer('sort_order')->default(0);

        $table->boolean('status')->default(1);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
