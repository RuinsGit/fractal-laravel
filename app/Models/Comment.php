<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'position',
        'image',
        'title_az',
        'title_en',
        'title_ru',
        'comment_az',
        'comment_en',
        'comment_ru',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
