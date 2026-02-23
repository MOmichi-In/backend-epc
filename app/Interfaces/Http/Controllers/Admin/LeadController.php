<?php

namespace App\Interfaces\Http\Controllers\Admin;

use App\Domain\Lead\Repositories\LeadRepositoryInterface;
use App\Interfaces\Http\Resources\LeadResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class LeadController extends Controller
{
    public function __construct(
        private readonly LeadRepositoryInterface $repository,
    ) {}

    public function index(): JsonResponse
    {
        $leads = $this->repository->findAll();
        return response()->json(LeadResource::collection($leads));
    }

    public function markAsRead(int $id): JsonResponse
    {
        $this->repository->markAsRead($id);
        return response()->json(['message' => 'Lead marcado como leído']);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->repository->delete($id);
        return response()->json(['message' => 'Lead eliminado']);
    }
}