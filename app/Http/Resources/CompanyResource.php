<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text_1' => $this->text1,
            'text_2' => $this->text2,
            'text_3' => $this->text3,
            'status' => $this->status
        ];
    }
} 