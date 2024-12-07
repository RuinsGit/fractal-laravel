<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HumanContentResource extends JsonResource
{
    public function toArray($request)
    {
       
        
        return [
            'id' => $this->id,
            'image' => $this->image ? url('uploads/human-content/' . basename($this->image)) : null,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status
        ];
    }
} 