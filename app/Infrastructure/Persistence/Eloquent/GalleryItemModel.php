<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class GalleryItemModel extends Model
{
    protected $table = 'gallery_items';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'category',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];
}