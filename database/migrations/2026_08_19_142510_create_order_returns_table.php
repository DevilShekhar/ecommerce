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
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('order_item_id')
                ->nullable()
                ->constrained('order_items')
                ->nullOnDelete();

            // Return request information
            $table->string('reason')->nullable();
            $table->text('customer_note')->nullable();

            // Optional proof/product images
            $table->json('images')->nullable();

            // Requested quantity
            $table->unsignedInteger('quantity')->default(1);

            // Amount that can be refunded
            $table->decimal('refund_amount', 12, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | Return Status
            |--------------------------------------------------------------------------
            |
            | pending
            | approved
            | rejected
            | received
            | completed
            |
            */
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'received',
                'completed',
            ])->default('pending');

            // Approval/rejection
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->foreignId('rejected_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('rejected_at')->nullable();

            $table->text('rejection_reason')->nullable();

            // Admin/Super Admin internal notes
            $table->text('admin_note')->nullable();

            // Refund information
            $table->enum('refund_status', [
                'not_required',
                'pending',
                'processing',
                'refunded',
                'failed',
            ])->default('not_required');

            $table->string('refund_method')->nullable();

            $table->string('refund_transaction_id')->nullable();

            $table->timestamp('refunded_at')->nullable();

            $table->foreignId('refunded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_returns');
    }
};
