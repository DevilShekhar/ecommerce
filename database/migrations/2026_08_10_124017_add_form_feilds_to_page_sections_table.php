<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->json('form_fields')->nullable()->after('faqs');
            $table->string('form_action')->nullable()->after('form_fields');
            $table->string('form_method')->default('POST')->after('form_action');
        });
    }

    public function down()
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn(['form_fields', 'form_action', 'form_method']);
        });
    }
};
