<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'brand_id',
        'name',
        'sku',
        'price',
        'stock',
        'variants',
        'specification',
        'image',
        'is_futured',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationship: Product belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Relationship: Product belongs to a SubCategory
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    /**
     * Relationship: Product belongs to a Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Relationship: Product created by User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship: Product updated by User
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}