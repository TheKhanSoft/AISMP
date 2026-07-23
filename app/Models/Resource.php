<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasSlug;
use App\Traits\Publishable;
use App\Enums\ResourceType;

class Resource extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'type',
        'file_url',
        'author',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'type' => ResourceType::class,
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
