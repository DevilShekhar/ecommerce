<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('contact_address');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('email')->nullable()->after('last_name');
            $table->string('enquiry_type')->nullable()->after('email');
            $table->text('message')->nullable()->after('enquiry_type');
        });
    }

    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'email',
                'enquiry_type',
                'message',
            ]);
        });
    }
};