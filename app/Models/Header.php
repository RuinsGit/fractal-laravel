<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $table = 'headers';

    protected $fillable = [
        'home_az', 'home_en', 'home_ru',
        'about_az', 'about_en', 'about_ru',
        'vision_az', 'vision_en', 'vision_ru',
        'history_az', 'history_en', 'history_ru',
        'leadership_az', 'leadership_en', 'leadership_ru',
        'services_az', 'services_en', 'services_ru',
        'our_services_az', 'our_services_en', 'our_services_ru',
        'courses_az', 'courses_en', 'courses_ru',
        'education_program_az', 'education_program_en', 'education_program_ru',
        'image',
        'status',
        'order'
    ];
} 