<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->string('disclaimer_title')->nullable()->after('policy_sections');
            $table->text('disclaimer_description')->nullable()->after('disclaimer_title');
        });
    }

    public function down()
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn(['disclaimer_title', 'disclaimer_description']);
        });
    }
};
