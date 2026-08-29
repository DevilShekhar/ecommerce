<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderStatusHistory extends Model
{
    protected $fillable = [
        'order_id',
        'old_status',
        'new_status',
        'notes',
        'changed_by',
        'changed_at',
    ];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function changer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    // Helper method to get status label
    public function getOldStatusLabelAttribute()
    {
        return $this->formatStatusLabel($this->old_status);
    }

    public function getNewStatusLabelAttribute()
    {
        return $this->formatStatusLabel($this->new_status);
    }

    private function formatStatusLabel($status)
    {
        if (!$status) return 'N/A';
        return ucwords(str_replace('_', ' ', $status));
    }
}
