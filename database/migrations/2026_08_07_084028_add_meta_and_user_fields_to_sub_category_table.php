<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_category', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('name');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->text('meta_keywords')->nullable()->after('meta_description');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->after('status');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null')->after('created_by');
        });
    }

    public function down(): void
    {
        Schema::table('sub_category', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords', 'created_by', 'updated_by']);
        });
    }
};