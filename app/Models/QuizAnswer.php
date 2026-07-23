<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAnswer extends Model
{
    protected $fillable = [
        'quiz_attempt_id',
        'quiz_question_id',
        'selected_option_id',
        'answer_text',
        'is_correct',
        'points_awarded',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'points_awarded' => 'integer',
    ];

    public function quizAttempt(): BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function quizQuestion(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function selectedOption(): BelongsTo
    {
        return $this->belongsTo(QuizOption::class, 'selected_option_id');
    }
}
