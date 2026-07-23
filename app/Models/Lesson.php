<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Sortable;

class Lesson extends Model
{
    use Sortable;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'is_published',
        'is_free',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_free' => 'boolean',
        'order' => 'integer',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessonContents(): HasMany
    {
        return $this->hasMany(LessonContent::class)->orderBy('order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFree(Builder $query): Builder
    {
        return $query->where('is_free', true);
    }
}
