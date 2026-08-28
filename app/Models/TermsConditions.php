<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsConditions extends Model
{
    protected $table = 'terms_conditions';

    protected $fillable = [
        'terms_conditions_category',
        'terms_conditions_title',
        'terms_conditions_subtitle',
        'terms_conditions_descripton',
        'terms_conditions_iamage',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
