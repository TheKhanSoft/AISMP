<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'score' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function scorePercentage(): float
    {
        $totalPoints = $this->quiz->questions()->sum('points');
        if ($totalPoints === 0) {
            return 0.0;
        }
        return round(($this->score / $totalPoints) * 100, 2);
    }

    public function isPassed(): bool
    {
        return $this->scorePercentage() >= $this->quiz->passing_score;
    }
}
