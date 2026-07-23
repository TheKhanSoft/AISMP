<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Sortable;
use App\Enums\LessonContentType;

class LessonContent extends Model
{
    use Sortable;

    protected $fillable = [
        'lesson_id',
        'title',
        'type',
        'content',
        'file_url',
        'duration_minutes',
        'order',
    ];

    protected $casts = [
        'type' => LessonContentType::class,
        'duration_minutes' => 'integer',
        'order' => 'integer',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
