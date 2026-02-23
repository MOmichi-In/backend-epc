<?php

namespace App\Domain\Content\Repositories;

use App\Domain\Content\Entities\Content;
use Illuminate\Support\Collection;

interface ContentRepositoryInterface
{
    public function findById(int $id): ?Content;
    public function findBySection(string $section): Collection;
    public function findAll(): Collection;
    public function save(Content $content): Content;
    public function update(int $id, Content $content): Content;
    public function delete(int $id): void;
}