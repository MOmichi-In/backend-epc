<?php

namespace App\Application\Content\UseCases;

use App\Application\Content\DTOs\ContentDTO;
use App\Domain\Content\Entities\Content;
use App\Domain\Content\Repositories\ContentRepositoryInterface;

class CreateContent
{
    public function __construct(
        private readonly ContentRepositoryInterface $repository,
    ) {}

    public function execute(ContentDTO $dto): Content
    {
        $content = Content::create(
            section:  $dto->section,
            title:    $dto->title,
            body:     $dto->body,
            imageUrl: $dto->imageUrl,
            isActive: $dto->isActive,
            order:    $dto->order,
        );

        return $this->repository->save($content);
    }
}