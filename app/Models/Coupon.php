<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'code',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
        'minimum_order_amount',
        'maximum_discount',
        'status',
        'meta_title',
        'meta_ads',
        'meta_keyword',
        'created_by',
        'updated_by',

    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_value' => 'decimal:2',
        'minimum_order_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'status' => 'boolean',
    ];

    /**
     * Coupon belongs to a Brand.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
