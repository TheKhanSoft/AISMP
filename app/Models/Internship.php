<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;
use App\Traits\Publishable;

class Internship extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'title',
        'slug',
        'company_name',
        'location',
        'description',
        'requirements',
        'duration',
        'stipend',
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
