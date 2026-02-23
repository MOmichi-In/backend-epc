<?php

namespace App\Domain\Gallery\Repositories;

use App\Domain\Gallery\Entities\GalleryItem;
use Illuminate\Support\Collection;

interface GalleryRepositoryInterface
{
    public function findById(int $id): ?GalleryItem;
    public function findAll(bool $onlyActive = false): Collection;
    public function findByCategory(string $category): Collection;
    public function save(GalleryItem $item): GalleryItem;
    public function update(int $id, GalleryItem $item): GalleryItem;
    public function delete(int $id): void;
}