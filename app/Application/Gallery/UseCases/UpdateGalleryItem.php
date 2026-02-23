<?php

namespace App\Application\Gallery\UseCases;

use App\Application\Gallery\DTOs\GalleryItemDTO;
use App\Domain\Gallery\Entities\GalleryItem;
use App\Domain\Gallery\Repositories\GalleryRepositoryInterface;

class UpdateGalleryItem
{
    public function __construct(
        private readonly GalleryRepositoryInterface $repository,
    ) {}

    public function execute(int $id, GalleryItemDTO $dto): GalleryItem
    {
        $item = GalleryItem::create(
            title:       $dto->title,
            imageUrl:    $dto->imageUrl,
            description: $dto->description,
            category:    $dto->category,
            isActive:    $dto->isActive,
            order:       $dto->order,
        );

        return $this->repository->update($id, $item);
    }
}