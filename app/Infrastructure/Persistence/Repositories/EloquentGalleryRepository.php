<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Gallery\Entities\GalleryItem;
use App\Domain\Gallery\Repositories\GalleryRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\GalleryItemModel;
use Illuminate\Support\Collection;

class EloquentGalleryRepository implements GalleryRepositoryInterface
{
    public function findById(int $id): ?GalleryItem
    {
        $model = GalleryItemModel::find($id);
        return $model ? $this->toDomain($model) : null;
    }

    public function findAll(bool $onlyActive = false): Collection
    {
        return GalleryItemModel::when($onlyActive, fn($q) => $q->where('is_active', true))
            ->orderBy('order')
            ->get()
            ->map(fn($m) => $this->toDomain($m));
    }

    public function findByCategory(string $category): Collection
    {
        return GalleryItemModel::where('category', $category)
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(fn($m) => $this->toDomain($m));
    }

    public function save(GalleryItem $item): GalleryItem
    {
        $model = GalleryItemModel::create([
            'title'       => $item->title,
            'description' => $item->description,
            'image_url'   => $item->imageUrl,
            'category'    => $item->category,
            'is_active'   => $item->isActive,
            'order'       => $item->order,
        ]);

        return $this->toDomain($model);
    }

    public function update(int $id, GalleryItem $item): GalleryItem
    {
        $model = GalleryItemModel::findOrFail($id);
        $model->update([
            'title'       => $item->title,
            'description' => $item->description,
            'image_url'   => $item->imageUrl,
            'category'    => $item->category,
            'is_active'   => $item->isActive,
            'order'       => $item->order,
        ]);

        return $this->toDomain($model->fresh());
    }

    public function delete(int $id): void
    {
        GalleryItemModel::findOrFail($id)->delete();
    }

    private function toDomain(GalleryItemModel $model): GalleryItem
    {
        return new GalleryItem(
            id:          $model->id,
            title:       $model->title,
            description: $model->description,
            imageUrl:    $model->image_url,
            category:    $model->category,
            isActive:    $model->is_active,
            order:       $model->order,
        );
    }
}