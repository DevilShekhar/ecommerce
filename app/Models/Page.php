<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)
            ->orderBy('sort_order');
    }
}
