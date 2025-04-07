<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'primary_color',
        'secondary_color',
        'accent_color',
        'background_color',
    ];
}
