<?php

namespace App\Application\Content\UseCases;

use App\Domain\Content\Repositories\ContentRepositoryInterface;

class DeleteContent
{
    public function __construct(
        private readonly ContentRepositoryInterface $repository,
    ) {}

    public function execute(int $id): void
    {
        $this->repository->delete($id);
    }
}