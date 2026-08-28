<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [

        // ABOUT
        'about_sub_title',
        'about_title',
        'about_description',
        'about_image',

        // MISSION
        'mission_sub_title',
        'mission_title',
        'mission_description',
        'mission_image',

        // VISION
        'vision_sub_title',
        'vision_title',
        'vision_description',
        'vision_image',

        // STATUS
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
