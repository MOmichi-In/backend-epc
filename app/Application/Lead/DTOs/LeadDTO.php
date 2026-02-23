<?php

namespace App\Application\Lead\DTOs;

class LeadDTO
{
    public function __construct(
        public readonly string  $name,
        public readonly string  $email,
        public readonly ?string $phone = null,
        public readonly ?string $message = null,
        public readonly string  $source = 'landing',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name:    $data['name'],
            email:   $data['email'],
            phone:   $data['phone'] ?? null,
            message: $data['message'] ?? null,
            source:  $data['source'] ?? 'landing',
        );
    }
}