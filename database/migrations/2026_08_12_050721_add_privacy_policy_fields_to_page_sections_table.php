<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->text('privacy_content')->nullable()->after('faqs');
            $table->text('terms_content')->nullable()->after('privacy_content');
            $table->text('policy_content')->nullable()->after('terms_content');
            $table->json('policy_sections')->nullable()->after('policy_content');
        });
    }

    public function down()
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn(['privacy_content', 'terms_content', 'policy_content', 'policy_sections']);
        });
    }
};
