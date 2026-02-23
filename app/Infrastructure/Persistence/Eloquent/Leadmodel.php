<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class LeadModel extends Model
{
    protected $table = 'leads';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'source',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];
}