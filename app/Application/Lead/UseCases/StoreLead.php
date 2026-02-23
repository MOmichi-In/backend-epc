<?php

namespace App\Application\Lead\UseCases;

use App\Application\Lead\DTOs\LeadDTO;
use App\Domain\Lead\Entities\Lead;
use App\Domain\Lead\Repositories\LeadRepositoryInterface;

class StoreLead
{
    public function __construct(
        private readonly LeadRepositoryInterface $repository,
    ) {}

    public function execute(LeadDTO $dto): Lead
    {
        $lead = Lead::create(
            name:    $dto->name,
            email:   $dto->email,
            phone:   $dto->phone,
            message: $dto->message,
            source:  $dto->source,
        );

        return $this->repository->save($lead);
    }
}