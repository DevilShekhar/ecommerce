<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'shipping',
        'discount',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
        'status_updated_at',
        'status_updated_by',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_country',
        'shipping_pincode',
        'latitude',
        'longitude',
        'notes',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'cancellation_reason', 'return_reason',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'status_updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusUpdatedBy()
    {
        return $this->belongsTo(User::class, 'status_updated_by');
    }

    public function returns()
    {
        return $this->hasMany(OrderReturn::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class)->orderBy('changed_at', 'desc');
    }

    public function latestStatusHistory()
    {
        return $this->hasOne(OrderStatusHistory::class)->latest('changed_at');
    }

    // Helper method to get status change history
    public function getStatusHistory()
    {
        return $this->statusHistories()->with('changer')->get();
    }

    // Helper to get formatted status history
    public function getFormattedStatusHistory()
    {
        return $this->statusHistories->map(function ($history) {
            return [
                'from' => $history->old_status_label,
                'to' => $history->new_status_label,
                'changed_by' => $history->changer?->name ?? 'System',
                'changed_at' => $history->changed_at->format('d M Y, h:i A'),
                'notes' => $history->notes,
            ];
        });
    }
}
