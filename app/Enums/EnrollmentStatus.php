<?php

declare(strict_types=1);

namespace App\Enums;

enum EnrollmentStatus: string
{
    case Active = 'active';
    case Completed = 'completed';
    case Dropped = 'dropped';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Completed => 'Completed',
            self::Dropped => 'Dropped',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'primary',
            self::Completed => 'success',
            self::Dropped => 'danger',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
