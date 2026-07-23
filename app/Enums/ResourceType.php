<?php

declare(strict_types=1);

namespace App\Enums;

enum ResourceType: string
{
    case Paper = 'paper';
    case Dataset = 'dataset';
    case Tool = 'tool';
    case Book = 'book';
    case Tutorial = 'tutorial';

    public function label(): string
    {
        return match ($this) {
            self::Paper => 'Paper',
            self::Dataset => 'Dataset',
            self::Tool => 'Tool',
            self::Book => 'Book',
            self::Tutorial => 'Tutorial',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Paper => 'primary',
            self::Dataset => 'success',
            self::Tool => 'warning',
            self::Book => 'info',
            self::Tutorial => 'secondary',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
