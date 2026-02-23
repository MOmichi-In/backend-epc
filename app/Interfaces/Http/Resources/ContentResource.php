<?php

namespace App\Interfaces\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'section'   => $this->section,
            'title'     => $this->title,
            'body'      => $this->body,
            'image_url' => $this->imageUrl,
            'is_active' => $this->isActive,
            'order'     => $this->order,
        ];
    }
}