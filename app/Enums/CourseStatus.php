<?php

declare(strict_types=1);

namespace App\Enums;

enum CourseStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
            self::Archived => 'Archived',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft => 'secondary',
            self::Published => 'success',
            self::Archived => 'danger',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
