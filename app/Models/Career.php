<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;
use App\Traits\Publishable;
use App\Enums\CareerType;

class Career extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $table = 'careers';

    protected $fillable = [
        'title',
        'slug',
        'company',
        'location',
        'type',
        'description',
        'requirements',
        'salary_range',
        'application_url',
        'application_email',
        'deadline',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'type' => CareerType::class,
        'deadline' => 'date',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
