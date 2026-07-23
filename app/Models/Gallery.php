<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasSlug;
use App\Traits\Publishable;
use App\Traits\Sortable;

class Gallery extends Model
{
    use SoftDeletes, HasSlug, Publishable, Sortable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'is_published',
        'published_at',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'order' => 'integer',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }
}
