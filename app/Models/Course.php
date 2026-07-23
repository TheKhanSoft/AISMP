<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasSlug;
use App\Traits\HasSeo;
use App\Traits\Publishable;
use App\Enums\CourseLevel;
use App\Enums\CourseStatus;

class Course extends Model
{
    use SoftDeletes, HasSlug, HasSeo, Publishable;

    protected $fillable = [
        'instructor_id',
        'title',
        'slug',
        'description',
        'level',
        'status',
        'learning_outcomes',
        'thumbnail_url',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'level' => CourseLevel::class,
        'status' => CourseStatus::class,
        'learning_outcomes' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates(): MorphMany
    {
        return $this->morphMany(Certificate::class, 'certificable');
    }

    public function scopeOfLevel(Builder $query, CourseLevel $level): Builder
    {
        return $query->where('level', $level);
    }
}
