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
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('status_updated_at')->nullable()->after('order_status');
            $table->unsignedBigInteger('status_updated_by')->nullable()->after('status_updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'status_updated_at',
                'status_updated_by',
            ]);
        });
    }
};
