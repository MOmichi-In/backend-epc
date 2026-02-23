<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ContentModel extends Model
{
    protected $table = 'contents';

    protected $fillable = [
        'section',
        'title',
        'body',
        'image_url',
        'is_active',
        'order',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];
}