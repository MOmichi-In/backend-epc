<?php

namespace App\Application\Gallery\DTOs;

class GalleryItemDTO
{
    public function __construct(
        public readonly string  $title,
        public readonly string  $imageUrl,
        public readonly ?string $description = null,
        public readonly ?string $category = null,
        public readonly bool    $isActive = true,
        public readonly int     $order = 0,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title:       $data['title'],
            imageUrl:    $data['image_url'],
            description: $data['description'] ?? null,
            category:    $data['category'] ?? null,
            isActive:    $data['is_active'] ?? true,
            order:       $data['order'] ?? 0,
        );
    }
}