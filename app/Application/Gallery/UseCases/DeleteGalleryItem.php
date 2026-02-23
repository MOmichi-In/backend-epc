<?php

namespace App\Application\Gallery\UseCases;

use App\Domain\Gallery\Repositories\GalleryRepositoryInterface;

class DeleteGalleryItem
{
    public function __construct(
        private readonly GalleryRepositoryInterface $repository,
    ) {}

    public function execute(int $id): void
    {
        $this->repository->delete($id);
    }
}