<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text_1_az' => $this->text_1_az,
            'text_2_az' => $this->text_2_az,
            'text_3_az' => $this->text_3_az,
            'text_1_en' => $this->text_1_en,
            'text_2_en' => $this->text_2_en,
            'text_3_en' => $this->text_3_en,
            'text_1_ru' => $this->text_1_ru,
            'text_2_ru' => $this->text_2_ru,
            'text_3_ru' => $this->text_3_ru,
            'status' => $this->status
        ];
    }
} 