<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privacy_policies', function (Blueprint $table) {
            $table->id();
            $table->string('privacy_policy_title');
            $table->string('privacy_policy_subtitle')->nullable();
            $table->longText('privacy_policy_description');
            $table->string('privacy_policy_image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privacy_policies');
    }
};
