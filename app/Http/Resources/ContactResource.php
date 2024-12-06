<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray($request)
    {
        $base_url = url('/');
        
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
                'logo' => $this->logo ? $base_url . '/' . $this->logo : null,
                'logo_2' => $this->logo_2 ? $base_url . '/' . $this->logo_2 : null,
                'favicon' => $this->favicon ? $base_url . '/' . $this->favicon : null
            ]
        ];
    }
} 