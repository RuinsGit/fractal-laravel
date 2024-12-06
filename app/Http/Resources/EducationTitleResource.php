<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationTitleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $base_url . $this->image,
            'name' => $this->name,
            'text' => $this->text,
            'status' => $this->status
        ];
    }
} 