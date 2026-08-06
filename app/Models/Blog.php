<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'created_by',
        'updated_by',
    ];

    public function faqs()
    {
        return $this->hasMany(BlogFaq::class);
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