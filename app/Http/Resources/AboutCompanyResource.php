<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutCompanyResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
        return [
            'id' => $this->id,
            'image' => $base_url . '/' . $this->image,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status
        ];
    }
} 