<?php

declare(strict_types=1);

namespace App\Enums;

enum PublicationType: string
{
    case Paper = 'paper';
    case Article = 'article';
    case Thesis = 'thesis';
    case Report = 'report';

    public function label(): string
    {
        return match ($this) {
            self::Paper => 'Paper',
            self::Article => 'Article',
            self::Thesis => 'Thesis',
            self::Report => 'Report',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Paper => 'primary',
            self::Article => 'info',
            self::Thesis => 'warning',
            self::Report => 'success',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
