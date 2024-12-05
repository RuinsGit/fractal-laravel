<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name_az',
        'name_en',
        'name_ru',
        // ... diğer alanlar
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
    }
}
