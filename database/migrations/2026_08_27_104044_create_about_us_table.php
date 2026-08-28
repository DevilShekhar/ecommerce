<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // About Us
            $table->string('about_sub_title')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();

            // Our Mission
            $table->string('mission_sub_title')->nullable();
            $table->string('mission_title')->nullable();
            $table->text('mission_description')->nullable();
            $table->string('mission_image')->nullable();

            // Our Vision
            $table->string('vision_sub_title')->nullable();
            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            $table->string('vision_image')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
