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

// Use Cases Content
use App\Application\Content\UseCases\CreateContent;
use App\Application\Content\UseCases\UpdateContent;
use App\Application\Content\UseCases\DeleteContent;

// Use Cases Gallery
use App\Application\Gallery\UseCases\CreateGalleryItem;
use App\Application\Gallery\UseCases\UpdateGalleryItem;
use App\Application\Gallery\UseCases\DeleteGalleryItem;

// Use Cases Lead
use App\Application\Lead\UseCases\StoreLead;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repositorios
        $this->app->bind(ContentRepositoryInterface::class, EloquentContentRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, EloquentGalleryRepository::class);
        $this->app->bind(LeadRepositoryInterface::class,    EloquentLeadRepository::class);

        // Use Cases
        $this->app->bind(CreateContent::class);
        $this->app->bind(UpdateContent::class);
        $this->app->bind(DeleteContent::class);
        $this->app->bind(CreateGalleryItem::class);
        $this->app->bind(UpdateGalleryItem::class);
        $this->app->bind(DeleteGalleryItem::class);
        $this->app->bind(StoreLead::class);
    }

    public function boot(): void
    {
        //
    }
}