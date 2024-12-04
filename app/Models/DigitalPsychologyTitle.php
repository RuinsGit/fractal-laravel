<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalPsychologyTitle extends Model
{
    use HasFactory;

    protected $table = 'digital_psychology_title';

    protected $fillable = [
        'image',
        'name_az',
        'name_en',
        'name_ru',
        'text_az',
        'text_en',
        'text_ru',
        'status'
    ];

    protected $attributes = [
        'image' => null,
        'name_az' => null,
        'name_en' => null,
        'name_ru' => null,
        'text_az' => null,
        'text_en' => null,
        'text_ru' => null,
        'status' => 1
    ];
}