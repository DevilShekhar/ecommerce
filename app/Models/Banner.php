<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'banner_type',
        'image',
        'category_id',
        'link_type',
        'link_value',
        'start_date',
        'end_date',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'boolean',
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'link_value');
    }

    // Scope for active banners
public function scopeActive($query)
{
    return $query->where('status', 1)
        ->where(function($q) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', now());
        })
        ->where(function($q) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', now());
        });
}

    // Get link URL - Simple version without route dependencies
    public function getLinkUrlAttribute()
    {
        if ($this->link_type == 'none' || !$this->link_value) {
            return '#';
        }

        if ($this->link_type == 'custom_url') {
            return $this->link_value;
        }

        if ($this->link_type == 'product') {
            // Simple URL without route
            return '/product/' . $this->link_value;
        }

        if ($this->link_type == 'category') {
            // Simple URL without route
            return '/category/' . $this->link_value;
        }

        return '#';
    }

    // Get display name for link value
    public function getLinkDisplayAttribute()
    {
        if ($this->link_type == 'none') {
            return '-';
        }

        if ($this->link_type == 'custom_url') {
            return $this->link_value;
        }

        if ($this->link_type == 'product') {
            return $this->product ? $this->product->name : 'Product not found';
        }

        if ($this->link_type == 'category') {
            return $this->category ? $this->category->name : 'Category not found';
        }

        return '-';
    }
}
