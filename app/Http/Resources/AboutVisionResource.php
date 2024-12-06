<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutVisionResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
        return [
            'id' => $this->id,
            'icon_1' => $base_url . '/' . $this->icon_1,
            'name1' => $this->name1,
            'text1' => $this->text1,
            'icon_2' => $base_url . '/' . $this->icon_2,
            'name2' => $this->name2,
            'text2' => $this->text2,
            'image' => $base_url . '/' . $this->image,
            'status' => $this->status
        ];
    }
} 