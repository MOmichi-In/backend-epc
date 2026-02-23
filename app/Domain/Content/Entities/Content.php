<?php

namespace App\Domain\Content\Entities;

class Content
{
    public function __construct(
        public readonly ?int    $id,
        public readonly string  $section,
        public readonly string  $title,
        public readonly ?string $body,
        public readonly ?string $imageUrl,
        public readonly bool    $isActive,
        public readonly int     $order,
    ) {}

    public static function create(
        string  $section,
        string  $title,
        ?string $body = null,
        ?string $imageUrl = null,
        bool    $isActive = true,
        int     $order = 0,
    ): self {
        return new self(
            id: null,
            section: $section,
            title: $title,
            body: $body,
            imageUrl: $imageUrl,
            isActive: $isActive,
            order: $order,
        );
    }
}