<?php

declare(strict_types=1);

namespace App\Enums;

enum QuizQuestionType: string
{
    case MultipleChoice = 'multiple_choice';
    case TrueFalse = 'true_false';
    case ShortAnswer = 'short_answer';

    public function label(): string
    {
        return match ($this) {
            self::MultipleChoice => 'Multiple Choice',
            self::TrueFalse => 'True False',
            self::ShortAnswer => 'Short Answer',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::MultipleChoice => 'primary',
            self::TrueFalse => 'warning',
            self::ShortAnswer => 'info',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
