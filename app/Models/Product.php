<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
        'slug',
        'rating',
        'rating_count',
        'total_videos',
        'download_count'
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

    public function getFinalPriceAttribute()
    {
        if ($this->discount_percentage > 0) {
            $discountAmount = ($this->price * $this->discount_percentage) / 100;
            return $this->price - $discountAmount;
        }
        return $this->price;
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' ₼';
    }

    public function getFormattedDiscountedPriceAttribute()
    {
        return number_format($this->discounted_price, 2) . ' ₼';
    }

    public function getThumbnailPathAttribute()
    {
        if ($this->thumbnail && file_exists(public_path($this->thumbnail))) {
            return $this->thumbnail;
        }
        return 'back/assets/images/no-image.png';
    }
}
