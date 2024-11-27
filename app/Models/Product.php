<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title_az',
        'title_en',
        'title_ru',
        'description_az',
        'description_en',
        'description_ru',
        'price',
        'image',
        'slug',
        'status'
    ];
    
    // İlişkiler
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
