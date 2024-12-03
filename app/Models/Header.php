<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'home_az', 'about_az', 'vision_az', 'history_az', 'leadership_az', 'services_az', 'our_services_az',
        'courses_az', 'study_program_az', 'digital_psychology_az', 'human_design_az', 'media_az', 'gallery_az',
        'blogs_az', 'contact_az',
        
        'home_en', 'about_en', 'vision_en', 'history_en', 'leadership_en', 'services_en', 'our_services_en',
        'courses_en', 'study_program_en', 'digital_psychology_en', 'human_design_en', 'media_en', 'gallery_en',
        'blogs_en', 'contact_en',
        
        'home_ru', 'about_ru', 'vision_ru', 'history_ru', 'leadership_ru', 'services_ru', 'our_services_ru',
        'courses_ru', 'study_program_ru', 'digital_psychology_ru', 'human_design_ru', 'media_ru', 'gallery_ru',
        'blogs_ru', 'contact_ru',
    ];
}