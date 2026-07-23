<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\EnrollmentStatus;

class Enrollment extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'status',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'status' => EnrollmentStatus::class,
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lessonProgress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function calculateProgress(): float
    {
        $totalLessons = $this->course->lessons()->count();
        if ($totalLessons === 0) {
            return 0.0;
        }

        $completedLessons = $this->lessonProgress()
            ->where('status', \App\Enums\LessonProgressStatus::Completed)
            ->count();

        return round(($completedLessons / $totalLessons) * 100, 2);
    }
}
