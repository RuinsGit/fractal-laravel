<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyNameResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_az' => $this->name_az,
            'name_en' => $this->name_en,
            'name_ru' => $this->name_ru,
            'text_az' => $this->text_az,
            'text_en' => $this->text_en,
            'text_ru' => $this->text_ru,
            'description_az' => $this->description_az,
            'description_en' => $this->description_en,
            'description_ru' => $this->description_ru,
            'status' => $this->status
        ];
    }
} 