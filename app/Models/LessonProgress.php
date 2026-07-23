<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\LessonProgressStatus;

class LessonProgress extends Model
{
    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'status' => LessonProgressStatus::class,
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
