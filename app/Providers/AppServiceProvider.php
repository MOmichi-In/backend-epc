<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Domain\Content\Repositories\ContentRepositoryInterface;
use App\Domain\Gallery\Repositories\GalleryRepositoryInterface;
use App\Domain\Lead\Repositories\LeadRepositoryInterface;

// Implementaciones
use App\Infrastructure\Persistence\Repositories\EloquentContentRepository;
use App\Infrastructure\Persistence\Repositories\EloquentGalleryRepository;
use App\Infrastructure\Persistence\Repositories\EloquentLeadRepository;

// Use Cases
use App\Application\Content\UseCases\CreateContent;
use App\Application\Content\UseCases\UpdateContent;
use App\Application\Content\UseCases\DeleteContent;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repositorios — Interface → Implementación concreta
        $this->app->bind(ContentRepositoryInterface::class, EloquentContentRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, EloquentGalleryRepository::class);
        $this->app->bind(LeadRepositoryInterface::class,    EloquentLeadRepository::class);

        // Use Cases — Laravel los resuelve con DI automático
        $this->app->bind(CreateContent::class);
        $this->app->bind(UpdateContent::class);
        $this->app->bind(DeleteContent::class);
    }

    public function boot(): void
    {
        //
    }
}