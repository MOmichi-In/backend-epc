<?php

namespace App\Interfaces\Http\Controllers\Admin;

use App\Application\Content\DTOs\ContentDTO;
use App\Application\Content\UseCases\CreateContent;
use App\Application\Content\UseCases\UpdateContent;
use App\Application\Content\UseCases\DeleteContent;
use App\Domain\Content\Repositories\ContentRepositoryInterface;
use App\Interfaces\Http\Resources\ContentResource;
use App\Interfaces\Http\Requests\Content\StoreContentRequest;
use App\Interfaces\Http\Requests\Content\UpdateContentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ContentController extends Controller
{
    public function __construct(
        private readonly ContentRepositoryInterface $repository,
        private readonly CreateContent              $createContent,
        private readonly UpdateContent              $updateContent,
        private readonly DeleteContent              $deleteContent,
    ) {}

    public function index(): JsonResponse
    {
        $contents = $this->repository->findAll();
        return response()->json(ContentResource::collection($contents));
    }

    public function store(StoreContentRequest $request): JsonResponse
    {
        $content = $this->createContent->execute(
            ContentDTO::fromArray($request->validated())
        );

        return response()->json(new ContentResource($content), 201);
    }

    public function update(UpdateContentRequest $request, int $id): JsonResponse
    {
        $content = $this->updateContent->execute(
            $id,
            ContentDTO::fromArray($request->validated())
        );

        return response()->json(new ContentResource($content));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteContent->execute($id);
        return response()->json(['message' => 'Contenido eliminado'], 200);
    }
}