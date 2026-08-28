<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('terms_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('terms_conditions_category')->nullable();
            $table->string('terms_conditions_title');
            $table->string('terms_conditions_subtitle')->nullable();
            $table->longText('terms_conditions_descripton');
            $table->string('terms_conditions_iamage')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terms_conditions');
    }
};
