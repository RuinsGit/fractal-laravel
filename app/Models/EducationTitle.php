<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationTitle extends Model
{
    use HasFactory;

    protected $table = 'education_title';

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

    
}