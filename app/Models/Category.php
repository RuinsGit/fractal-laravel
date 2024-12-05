<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $guarded = [];

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale());
    }
}
