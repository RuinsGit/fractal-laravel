<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutVision extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon_1',
        'name_1_az',
        'name_1_en',
        'name_1_ru',
        'text_1_az',
        'text_1_en',
        'text_1_ru',
        'icon_2',
        'name_2_az',
        'name_2_en',
        'name_2_ru',
        'text_2_az',
        'text_2_en',
        'text_2_ru',
        'image',
        'status'
    ];
}