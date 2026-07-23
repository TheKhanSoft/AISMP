<?php

declare(strict_types=1);

namespace App\Enums;

enum LessonContentType: string
{
    case Video = 'video';
    case Pdf = 'pdf';
    case Text = 'text';
    case Download = 'download';

    public function label(): string
    {
        return match ($this) {
            self::Video => 'Video',
            self::Pdf => 'Pdf',
            self::Text => 'Text',
            self::Download => 'Download',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Video => 'danger',
            self::Pdf => 'info',
            self::Text => 'primary',
            self::Download => 'success',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
