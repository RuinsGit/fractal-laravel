<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image ? $base_url . '/' . $this->image : null
        ];
    }
} 