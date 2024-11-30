<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'title_az',
        'title_en',
        'title_ru',
        'description_az',
        'description_en',
        'description_ru',
        'category_id',
        'sub_category_id',
        'price',
        'discount_percentage',
        'discounted_price',
        'thumbnail',
        'preview_video',
        'status',
        'order',
        'slug'
    ];

    // Category ilişkisi
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // SubCategory ilişkisi
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // OrderProducts ilişkisi
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // Videos ilişkisi
    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
    }
}
