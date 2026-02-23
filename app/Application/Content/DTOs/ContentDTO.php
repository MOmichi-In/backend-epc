<?php

namespace App\Application\Content\DTOs;

class ContentDTO
{
    public function __construct(
        public readonly string  $section,
        public readonly string  $title,
        public readonly ?string $body,
        public readonly ?string $imageUrl,
        public readonly bool    $isActive = true,
        public readonly int     $order = 0,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            section:  $data['section'],
            title:    $data['title'],
            body:     $data['body'] ?? null,
            imageUrl: $data['image_url'] ?? null,
            isActive: $data['is_active'] ?? true,
            order:    $data['order'] ?? 0,
        );
    }
}