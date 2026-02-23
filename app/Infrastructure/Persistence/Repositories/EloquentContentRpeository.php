<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Content\Entities\Content;
use App\Domain\Content\Repositories\ContentRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\ContentModel;
use Illuminate\Support\Collection;

class EloquentContentRepository implements ContentRepositoryInterface
{
    public function findById(int $id): ?Content
    {
        $model = ContentModel::find($id);
        return $model ? $this->toDomain($model) : null;
    }

    public function findBySection(string $section): Collection
    {
        return ContentModel::where('section', $section)
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(fn($m) => $this->toDomain($m));
    }

    public function findAll(): Collection
    {
        return ContentModel::orderBy('section')
            ->orderBy('order')
            ->get()
            ->map(fn($m) => $this->toDomain($m));
    }

    public function save(Content $content): Content
    {
        $model = ContentModel::create([
            'section'   => $content->section,
            'title'     => $content->title,
            'body'      => $content->body,
            'image_url' => $content->imageUrl,
            'is_active' => $content->isActive,
            'order'     => $content->order,
        ]);

        return $this->toDomain($model);
    }

    public function update(int $id, Content $content): Content
    {
        $model = ContentModel::findOrFail($id);
        $model->update([
            'section'   => $content->section,
            'title'     => $content->title,
            'body'      => $content->body,
            'image_url' => $content->imageUrl,
            'is_active' => $content->isActive,
            'order'     => $content->order,
        ]);

        return $this->toDomain($model->fresh());
    }

    public function delete(int $id): void
    {
        ContentModel::findOrFail($id)->delete();
    }

    // Mapeo Eloquent → Domain Entity (capa de infraestructura no sube al dominio)
    private function toDomain(ContentModel $model): Content
    {
        return new Content(
            id:       $model->id,
            section:  $model->section,
            title:    $model->title,
            body:     $model->body,
            imageUrl: $model->image_url,
            isActive: $model->is_active,
            order:    $model->order,
        );
    }
}