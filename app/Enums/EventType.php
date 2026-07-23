<?php

declare(strict_types=1);

namespace App\Enums;

enum EventType: string
{
    case Workshop = 'workshop';
    case Seminar = 'seminar';
    case Bootcamp = 'bootcamp';
    case Hackathon = 'hackathon';
    case Competition = 'competition';
    case Conference = 'conference';

    public function label(): string
    {
        return match ($this) {
            self::Workshop => 'Workshop',
            self::Seminar => 'Seminar',
            self::Bootcamp => 'Bootcamp',
            self::Hackathon => 'Hackathon',
            self::Competition => 'Competition',
            self::Conference => 'Conference',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Workshop => 'primary',
            self::Seminar => 'info',
            self::Bootcamp => 'success',
            self::Hackathon => 'warning',
            self::Competition => 'danger',
            self::Conference => 'primary',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
