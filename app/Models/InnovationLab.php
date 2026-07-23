<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;
use App\Traits\Publishable;

class InnovationLab extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'equipment',
        'technologies',
        'location',
        'contact_email',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
