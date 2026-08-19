<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Change status column from ENUM to VARCHAR(50)
        Schema::table('order_returns', function (Blueprint $table) {
            $table->string('status', 50)->default('pending')->change();
        });
    }

    public function down(): void
    {
        // Rollback - change back to ENUM if needed
        Schema::table('order_returns', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected', 'received', 'completed'])
                ->default('pending')
                ->change();
        });
    }
};
