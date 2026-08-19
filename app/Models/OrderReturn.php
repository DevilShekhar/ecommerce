<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;

    protected $table = 'order_returns';

    protected $fillable = [
        'order_id',
        'user_id',
        'order_item_id',
        'reason',
        'customer_note',
        'images',
        'quantity',
        'refund_amount',
        'status',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at',
        'rejection_reason',
        'admin_note',
        'refund_status',
        'refund_method',
        'refund_transaction_id',
        'refunded_at',
        'refunded_by',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'refunded_at' => 'datetime',
        'return_requested_at' => 'datetime',
        'images' => 'array',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function refundedBy()
    {
        return $this->belongsTo(User::class, 'refunded_by');
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'pending' || $this->status === 'return_requested';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isRefunded()
    {
        return $this->status === 'refunded';
    }
}
