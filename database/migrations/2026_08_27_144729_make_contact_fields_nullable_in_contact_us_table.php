<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->string('contact_sub_title')->nullable()->change();
            $table->string('contact_title')->nullable()->change();
            $table->text('contact_description')->nullable()->change();
            $table->string('contact_image')->nullable()->change();
            $table->string('contact_phone')->nullable()->change();
            $table->string('contact_email')->nullable()->change();
            $table->string('contact_whatsapp_no')->nullable()->change();
            $table->text('contact_address')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->string('contact_sub_title')->nullable(false)->change();
            $table->string('contact_title')->nullable(false)->change();
            $table->text('contact_description')->nullable(false)->change();
            $table->string('contact_image')->nullable()->change();
            $table->string('contact_phone')->nullable()->change();
            $table->string('contact_email')->nullable()->change();
            $table->string('contact_whatsapp_no')->nullable()->change();
            $table->text('contact_address')->nullable(false)->change();
        });
    }
};
