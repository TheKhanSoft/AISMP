<?php

declare(strict_types=1);

namespace App\Enums;

enum TrainingMode: string
{
    case Online = 'online';
    case Offline = 'offline';
    case Hybrid = 'hybrid';

    public function label(): string
    {
        return match ($this) {
            self::Online => 'Online',
            self::Offline => 'Offline',
            self::Hybrid => 'Hybrid',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Online => 'primary',
            self::Offline => 'secondary',
            self::Hybrid => 'warning',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
