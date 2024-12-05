<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_az' => $this->name_az,
            'name_en' => $this->name_en,
            'name_ru' => $this->name_ru,
            'title_az' => $this->title_az,
            'title_en' => $this->title_en,
            'title_ru' => $this->title_ru,
            'description_az' => $this->description_az,
            'description_en' => $this->description_en,
            'description_ru' => $this->description_ru,
            'price' => $this->price,
            'discount_percentage' => $this->discount_percentage,
            'discounted_price' => $this->discounted_price,
            'thumbnail' => $this->thumbnail,
            'preview_video' => $this->preview_video,
            'slug' => $this->slug,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'sub_category' => new SubCategoryResource($this->whenLoaded('sub_category')),
            'videos' => ProductVideoResource::collection($this->whenLoaded('videos')),
        ];
    }
} 