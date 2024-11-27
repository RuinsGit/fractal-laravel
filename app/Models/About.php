<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'content_az',
        'content_en',
        'content_ru',
        'image'
    ];
}
