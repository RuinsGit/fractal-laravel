<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
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