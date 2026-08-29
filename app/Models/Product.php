<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        'slug',
        'sku',
        'price',
        'stock',
        'variants',
        'specification',
        'description',
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

    public function pageSections()
    {
        return $this->belongsToMany(
            PageSection::class,
            'page_section_products',
            'product_id',
            'page_section_id'
        )->withPivot('sort_order');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function isInWishlist($userId = null)
    {
        if (! $userId) {
            $userId = Auth::id();
        }
        if (! $userId) {
            return false;
        }

        return $this->wishlists()->where('user_id', $userId)->exists();
    }

    public function latestInventoryTransaction()
    {
        return $this->hasOne(InventoryTransaction::class)->latestOfMany();
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function getRouteKeyName()
{
    return 'slug';
}

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = static::generateUniqueSlug($product->name);
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = static::generateUniqueSlug(
                    $product->name,
                    $product->id
                );
            }
        });
    }

    protected static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (
            static::query()->where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
