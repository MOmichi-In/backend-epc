<?php

namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Gallery\DTOs\GalleryItemDTO;
use App\Application\Gallery\UseCases\CreateGalleryItem;
use App\Application\Gallery\UseCases\UpdateGalleryItem;
use App\Application\Gallery\UseCases\DeleteGalleryItem;
use App\Domain\Gallery\Repositories\GalleryRepositoryInterface;
use App\Infrastructure\Storage\ImageStorageService;
use App\Interfaces\Http\Resources\GalleryItemResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    public function __construct(
        private readonly GalleryRepositoryInterface $repository,
        private readonly CreateGalleryItem          $createItem,
        private readonly UpdateGalleryItem          $updateItem,
        private readonly DeleteGalleryItem          $deleteItem,
        private readonly ImageStorageService        $storage,
    ) {}

    public function index(): JsonResponse
    {
        $items = $this->repository->findAll();
        return response()->json(GalleryItemResource::collection($items));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);

        $imageUrl = $this->storage->upload($request->file('image'), 'gallery');

        $item = $this->createItem->execute(GalleryItemDTO::fromArray([
            'title'       => $request->title,
            'image_url'   => $imageUrl,
            'description' => $request->description,
            'category'    => $request->category,
            'is_active'   => $request->boolean('is_active', true),
            'order'       => $request->integer('order', 0),
        ]));

        return response()->json(new GalleryItemResource($item), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);

        $existing = $this->repository->findById($id);
        $imageUrl = $existing->imageUrl;

        // Si subió nueva imagen, reemplazar
        if ($request->hasFile('image')) {
            $this->storage->delete($existing->imageUrl);
            $imageUrl = $this->storage->upload($request->file('image'), 'gallery');
        }

        $item = $this->updateItem->execute($id, GalleryItemDTO::fromArray([
            'title'       => $request->title,
            'image_url'   => $imageUrl,
            'description' => $request->description,
            'category'    => $request->category,
            'is_active'   => $request->boolean('is_active', true),
            'order'       => $request->integer('order', 0),
        ]));

        return response()->json(new GalleryItemResource($item));
    }

    public function destroy(int $id): JsonResponse
    {
        $item = $this->repository->findById($id);

        if ($item) {
            $this->storage->delete($item->imageUrl);
        }

        $this->deleteItem->execute($id);

        return response()->json(['message' => 'Imagen eliminada'], 200);
    }
}