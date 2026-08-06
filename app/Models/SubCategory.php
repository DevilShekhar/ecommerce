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
    ];

    /**
     * Get the parent category for the sub-category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}