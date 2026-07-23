<?php

declare(strict_types=1);

namespace App\Enums;

enum MembershipStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Expired = 'expired';
    case Suspended = 'suspended';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
            self::Expired => 'Expired',
            self::Suspended => 'Suspended',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'success',
            self::Rejected => 'danger',
            self::Expired => 'secondary',
            self::Suspended => 'danger',
        };
    }

    public function badge(): string
    {
        return "<span class=\"badge badge-$this->color()\">{$this->label()}</span>";
    }
}
