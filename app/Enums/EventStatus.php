<?php

declare(strict_types=1);

namespace App\Enums;

enum EventStatus: string
{
    case Upcoming = 'upcoming';
    case Ongoing = 'ongoing';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Upcoming => 'Upcoming',
            self::Ongoing => 'Ongoing',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Upcoming => 'primary',
            self::Ongoing => 'warning',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
