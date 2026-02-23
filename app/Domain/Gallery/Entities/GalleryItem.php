<?php

namespace App\Domain\Gallery\Entities;

class GalleryItem
{
    public function __construct(
        public readonly ?int    $id,
        public readonly string  $title,
        public readonly ?string $description,
        public readonly string  $imageUrl,
        public readonly ?string $category,
        public readonly bool    $isActive,
        public readonly int     $order,
    ) {}

    public static function create(
        string  $title,
        string  $imageUrl,
        ?string $description = null,
        ?string $category = null,
        bool    $isActive = true,
        int     $order = 0,
    ): self {
        return new self(
            id:          null,
            title:       $title,
            description: $description,
            imageUrl:    $imageUrl,
            category:    $category,
            isActive:    $isActive,
            order:       $order,
        );
    }
}