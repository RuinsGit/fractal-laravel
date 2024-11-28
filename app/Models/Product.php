<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getDiscountedPriceAttribute()
    {
        if ($this->hasDiscount()) {
            $discountAmount = ($this->sale_price * min($this->discount, 100)) / 100;
            return max($this->sale_price - $discountAmount, 0);
        }
        return $this->sale_price;
    }

    public function hasDiscount()
    {
        return !is_null($this->discount) && $this->discount > 0;
    }

    public function getOriginalPriceFormattedAttribute()
    {
        return number_format($this->sale_price, 2) . ' ₼';
    }

    public function getDiscountedPriceFormattedAttribute()
    {
        return number_format($this->discounted_price, 2) . ' ₼';
    }

    public function getImagePathAttribute()
    {
        if ($this->image && file_exists(public_path('uploads/products/' . $this->image))) {
            return 'uploads/products/' . $this->image;
        }
        return 'back/assets/images/no-image.png'; // varsayılan resim
    }

    public function getDiscountPercentageAttribute()
    {
        return $this->discount ? min($this->discount, 100) . '%' : null;
    }

    public function price()
    {
        return $this->discounted_price;
    }
}
