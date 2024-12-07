<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutVisionResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'icon_1' => $this->icon_1 ? url('uploads/about/vision/' . basename($this->icon_1)) : null,
            'name1' => $this->name1,
            'text1' => $this->text1,
            'icon_2' => $this->icon_2 ? url('uploads/about/vision/' . basename($this->icon_2)) : null,
            'name2' => $this->name2,
            'text2' => $this->text2,
            'image' => $this->image ? url('uploads/about/vision/' . basename($this->image)) : null,
            'status' => $this->status
        ];
    }
} 