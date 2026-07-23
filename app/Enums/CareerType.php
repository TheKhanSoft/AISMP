<?php

declare(strict_types=1);

namespace App\Enums;

enum CareerType: string
{
    case FullTime = 'full_time';
    case PartTime = 'part_time';
    case Contract = 'contract';
    case Remote = 'remote';

    public function label(): string
    {
        return match ($this) {
            self::FullTime => 'Full Time',
            self::PartTime => 'Part Time',
            self::Contract => 'Contract',
            self::Remote => 'Remote',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::FullTime => 'primary',
            self::PartTime => 'info',
            self::Contract => 'warning',
            self::Remote => 'success',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
