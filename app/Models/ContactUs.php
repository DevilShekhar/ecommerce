<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'contact_sub_title',
        'contact_title',
        'contact_description',
        'contact_image',
        'contact_phone',
        'contact_email',
        'contact_whatsapp_no',
        'contact_address',
        'status',
        // Customer Enquiry
        'first_name',
        'last_name',
        'email',
        'enquiry_type',
        'message',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
