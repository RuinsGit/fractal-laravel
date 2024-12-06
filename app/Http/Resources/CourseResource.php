<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
        return [
            'id' => $this->id,
            'image' => $base_url . $this->image,
            'name_az' => $this->name_az,
            'name_en' => $this->name_en,
            'name_ru' => $this->name_ru,
            'text_az' => $this->text_az,
            'text_en' => $this->text_en,
            'text_ru' => $this->text_ru,
            'status' => $this->status
        ];
    }
} 