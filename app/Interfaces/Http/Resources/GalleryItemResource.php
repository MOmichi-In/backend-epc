<?php

namespace App\Interfaces\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'image_url'   => $this->imageUrl,
            'category'    => $this->category,
            'is_active'   => $this->isActive,
            'order'       => $this->order,
        ];
    }
}