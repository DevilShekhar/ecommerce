<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;

    protected $table = 'privacy_policies';

    protected $fillable = [
        'privacy_policy_category',
        'privacy_policy_title',
        'privacy_policy_subtitle',
        'privacy_policy_description',
        'privacy_policy_image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
