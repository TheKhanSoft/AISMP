<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Sortable;

class Quiz extends Model
{
    use Sortable;

    protected $fillable = [
        'quizzable_id',
        'quizzable_type',
        'title',
        'description',
        'passing_score',
        'time_limit_minutes',
        'order',
    ];

    protected $casts = [
        'passing_score' => 'integer',
        'time_limit_minutes' => 'integer',
        'order' => 'integer',
    ];

    public function quizzable(): MorphTo
    {
        return $this->morphTo();
    }

    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
