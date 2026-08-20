<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'order_item_id',
        'rating',
    ];
}
