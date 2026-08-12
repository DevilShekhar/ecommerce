<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'section_type',
        'title',
        'sub_title',
        'content',
        'image',
        'images',
        'button_text',
        'button_url',
        'settings',
        'sort_order',
        'status',
        'faqs',
        'form_fields',
        'form_action',
        'form_method',
        'addresses',
        'logo',
        'privacy_content',
        'terms_content',
        'policy_content',
        'policy_sections',
        'disclaimer_title',
        'disclaimer_description',
    ];

    protected $casts = [
        'settings' => 'array',
        'status' => 'boolean',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'page_section_products',
            'page_section_id',
            'product_id'
        )->withPivot('sort_order')
            ->orderBy('page_section_products.sort_order');
    }
}
