<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DigitalPsychologyTitleResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
        return [
            'id' => $this->id,
            'image' => $this->image ? $base_url . $this->image : null,
            'name' => $this->name,
            'text' => $this->text,
            'status' => $this->status
        ];
    }
} 