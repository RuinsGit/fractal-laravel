<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'count'
    ];
    
    // İlişkiler
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
