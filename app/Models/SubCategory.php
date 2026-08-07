<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    protected $fillable = [
        'category_id',
        'name',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the parent category for the sub-category.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
