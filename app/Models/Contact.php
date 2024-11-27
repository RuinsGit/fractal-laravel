<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address_az',
        'address_en',
        'address_ru',
        'phone',
        'email',
        'facebook',
        'instagram',
        'twitter',
        'linkedin'
    ];
}
