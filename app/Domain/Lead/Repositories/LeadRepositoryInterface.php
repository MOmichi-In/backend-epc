<?php

namespace App\Domain\Lead\Repositories;

use App\Domain\Lead\Entities\Lead;
use Illuminate\Support\Collection;

interface LeadRepositoryInterface
{
    public function findById(int $id): ?Lead;
    public function findAll(): Collection;
    public function findUnread(): Collection;
    public function save(Lead $lead): Lead;
    public function markAsRead(int $id): void;
    public function delete(int $id): void;
}