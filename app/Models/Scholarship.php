<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;
use App\Traits\Publishable;

class Scholarship extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'title',
        'slug',
        'provider',
        'description',
        'eligibility',
        'amount',
        'application_url',
        'deadline',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
