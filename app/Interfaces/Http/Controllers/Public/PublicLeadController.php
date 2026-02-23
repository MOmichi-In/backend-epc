<?php

namespace App\Interfaces\Http\Controllers\Public;

use App\Application\Lead\DTOs\LeadDTO;
use App\Application\Lead\UseCases\StoreLead;
use App\Interfaces\Http\Resources\LeadResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PublicLeadController extends Controller
{
    public function __construct(
        private readonly StoreLead $storeLead,
    ) {}

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'message' => 'nullable|string|max:2000',
        ]);

        $lead = $this->storeLead->execute(LeadDTO::fromArray(
            $request->only(['name', 'email', 'phone', 'message'])
        ));

        return response()->json([
            'message' => '¡Gracias! Nos pondremos en contacto contigo pronto.',
            'id'      => $lead->id,
        ], 201);
    }
}