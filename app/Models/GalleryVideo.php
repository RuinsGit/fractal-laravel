<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryVideo extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'video',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}