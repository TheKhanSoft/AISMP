<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;
use App\Traits\Publishable;
use App\Enums\TrainingMode;

class TrainingProgram extends Model
{
    use SoftDeletes, HasSlug, Publishable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'mode',
        'location',
        'duration',
        'fee',
        'start_date',
        'registration_deadline',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'mode' => TrainingMode::class,
        'fee' => 'decimal:2',
        'start_date' => 'date',
        'registration_deadline' => 'date',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
