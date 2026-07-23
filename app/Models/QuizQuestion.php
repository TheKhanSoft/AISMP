<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Sortable;
use App\Enums\QuizQuestionType;

class QuizQuestion extends Model
{
    use Sortable;

    protected $fillable = [
        'quiz_id',
        'type',
        'question',
        'explanation',
        'points',
        'order',
    ];

    protected $casts = [
        'type' => QuizQuestionType::class,
        'points' => 'integer',
        'order' => 'integer',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuizOption::class)->orderBy('order');
    }
}
