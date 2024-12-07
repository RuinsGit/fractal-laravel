<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'workhours' => $this->workhours,
            'social_media' => [
                'facebook' => $this->facebook,
                'instagram' => $this->instagram,
                'youtube' => $this->youtube
            ],
            'images' => [
                'logo' => $this->logo ? url('uploads/contact/' . basename($this->logo)) : null,
                'logo_2' => $this->logo_2 ? url('uploads/contact/' . basename($this->logo_2)) : null,
                'favicon' => $this->favicon ? url('uploads/contact/' . basename($this->favicon)) : null
            ]
        ];
    }
} 