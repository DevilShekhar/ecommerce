<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOffer extends Model
{
    protected $fillable = [
        'user_id',
        'offer_id',
        'status',
        'sent_at',
        'viewed_at',
        'used_at',
        'coupon_code',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sent_at' => 'datetime',
        'viewed_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
