<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryVideoResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'video' => $this->video ? $base_url . '/uploads/gallery-videos/' . $this->video : null,
            'status' => $this->status
        ];
    }
} 