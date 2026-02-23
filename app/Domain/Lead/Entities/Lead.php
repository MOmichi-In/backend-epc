<?php

namespace App\Domain\Lead\Entities;

class Lead
{
    public function __construct(
        public readonly ?int    $id,
        public readonly string  $name,
        public readonly string  $email,
        public readonly ?string $phone,
        public readonly ?string $message,
        public readonly string  $source,
        public readonly bool    $isRead,
    ) {}

    public static function create(
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $message = null,
        string  $source = 'landing',
    ): self {
        return new self(
            id:      null,
            name:    $name,
            email:   $email,
            phone:   $phone,
            message: $message,
            source:  $source,
            isRead:  false,
        );
    }
}