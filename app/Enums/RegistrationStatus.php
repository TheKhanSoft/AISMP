<?php

declare(strict_types=1);

namespace App\Enums;

enum RegistrationStatus: string
{
    case Registered = 'registered';
    case Confirmed = 'confirmed';
    case Attended = 'attended';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Registered => 'Registered',
            self::Confirmed => 'Confirmed',
            self::Attended => 'Attended',
            self::Cancelled => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Registered => 'warning',
            self::Confirmed => 'success',
            self::Attended => 'info',
            self::Cancelled => 'danger',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
