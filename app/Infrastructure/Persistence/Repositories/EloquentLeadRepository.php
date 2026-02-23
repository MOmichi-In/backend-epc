<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Lead\Entities\Lead;
use App\Domain\Lead\Repositories\LeadRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\LeadModel;
use Illuminate\Support\Collection;

class EloquentLeadRepository implements LeadRepositoryInterface
{
    public function findById(int $id): ?Lead
    {
        $model = LeadModel::find($id);
        return $model ? $this->toDomain($model) : null;
    }

    public function findAll(): Collection
    {
        return LeadModel::latest()->get()->map(fn($m) => $this->toDomain($m));
    }

    public function findUnread(): Collection
    {
        return LeadModel::where('is_read', false)
            ->latest()
            ->get()
            ->map(fn($m) => $this->toDomain($m));
    }

    public function save(Lead $lead): Lead
    {
        $model = LeadModel::create([
            'name'    => $lead->name,
            'email'   => $lead->email,
            'phone'   => $lead->phone,
            'message' => $lead->message,
            'source'  => $lead->source,
            'is_read' => false,
        ]);

        return $this->toDomain($model);
    }

    public function markAsRead(int $id): void
    {
        LeadModel::findOrFail($id)->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    public function delete(int $id): void
    {
        LeadModel::findOrFail($id)->delete();
    }

    private function toDomain(LeadModel $model): Lead
    {
        return new Lead(
            id:      $model->id,
            name:    $model->name,
            email:   $model->email,
            phone:   $model->phone,
            message: $model->message,
            source:  $model->source,
            isRead:  $model->is_read,
        );
    }
}