<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
            'image' => $this->image ? $base_url . '/' . $this->image : null,
            'title' => $this->title,
            'comment' => $this->comment,
            'status' => $this->status
        ];
    }
} 