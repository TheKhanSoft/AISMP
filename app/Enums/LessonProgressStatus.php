<?php

declare(strict_types=1);

namespace App\Enums;

enum LessonProgressStatus: string
{
    case NotStarted = 'not_started';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::NotStarted => 'Not Started',
            self::InProgress => 'In Progress',
            self::Completed => 'Completed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::NotStarted => 'secondary',
            self::InProgress => 'warning',
            self::Completed => 'success',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
