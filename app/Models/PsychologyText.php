<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologyText extends Model
{
    use HasFactory;

    protected $table = 'psychology_text';

    protected $fillable = [
        'text_az',
        'text_en',
        'text_ru',
        'status'
    ];

    public function getTextAttribute()
    {
        return $this->getAttribute('text_' . app()->getLocale());
    }
}
