<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'question',
        'answer',
        'created_by',
        'updated_by',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
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