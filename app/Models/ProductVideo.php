<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    protected $fillable = [
        'product_id',
        'title',
        'video_path',
        'duration',
        'order',
        'download_count',
        'rating',
        'view_count'
    ];

    protected $attributes = [
        'download_count' => 0,
        'rating' => 5,
        'view_count' => 0,
        'duration' => 0
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedDurationAttribute()
    {
        $duration = $this->duration ?? 0;
        
        if ($duration < 60) {
            return $duration . ' saniyə';
        } elseif ($duration < 3600) {
            $minutes = floor($duration / 60);
            $seconds = $duration % 60;
            return sprintf('%02d:%02d', $minutes, $seconds);
        } else {
            $hours = floor($duration / 3600);
            $minutes = floor(($duration % 3600) / 60);
            $seconds = $duration % 60;
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
    }

    public function getRatingStarsAttribute()
    {
        $rating = $this->rating ?? 5;
        $html = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $html .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $html .= '<i class="far fa-star text-warning"></i>';
            }
        }
        return $html;
    }

    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}