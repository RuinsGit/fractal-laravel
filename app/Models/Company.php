<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'text_1_az',
        'text_2_az',
        'text_3_az',
        'text_1_en',
        'text_2_en',
        'text_3_en',
        'text_1_ru',
        'text_2_ru',
        'text_3_ru',
        'status'
    ];

    public function getText1Attribute()
    {
        return $this->getAttribute('text_1_' . app()->getLocale());
    }

    public function getText2Attribute()
    {
        return $this->getAttribute('text_2_' . app()->getLocale());
    }

    public function getText3Attribute()
    {
        return $this->getAttribute('text_3_' . app()->getLocale());
    }
}
