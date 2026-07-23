<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;
use App\Traits\Publishable;
use App\Enums\PublicationType;

class Publication extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'title',
        'slug',
        'abstract',
        'type',
        'authors',
        'publication_date',
        'journal_name',
        'doi',
        'file_url',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'type' => PublicationType::class,
        'authors' => 'array',
        'publication_date' => 'date',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
