<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = [
        'logo',
        'favicon',
    ];

    public function getFaviconUrlAttribute()
    {
        if ($this->favicon) {
            return asset('storage/'.$this->favicon);
        }

        return asset('favicon.ico');
    }

    // Get logo URL
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/'.$this->logo);
        }

        return null;
    }
}
