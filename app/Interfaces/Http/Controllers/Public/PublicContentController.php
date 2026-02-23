<?php

namespace App\Interfaces\Http\Controllers\Public;

use App\Domain\Content\Repositories\ContentRepositoryInterface;
use App\Interfaces\Http\Resources\ContentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PublicContentController extends Controller
{
    public function __construct(
        private readonly ContentRepositoryInterface $repository,
    ) {}

    public function bySection(string $section): JsonResponse
    {
        $contents = $this->repository->findBySection($section);
        return response()->json(ContentResource::collection($contents));
    }
}