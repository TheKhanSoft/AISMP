<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\MembershipStatus;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'membership_type_id',
        'status',
        'start_date',
        'end_date',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'status' => MembershipStatus::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function membershipType(): BelongsTo
    {
        return $this->belongsTo(MembershipType::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function renewals(): HasMany
    {
        return $this->hasMany(MembershipRenewal::class);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', MembershipStatus::Pending);
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', MembershipStatus::Approved);
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('status', MembershipStatus::Expired);
    }

    public function isExpired(): bool
    {
        return $this->end_date && $this->end_date->isPast();
    }

    public function isActive(): bool
    {
        return $this->status === MembershipStatus::Approved && !$this->isExpired();
    }

    public function approve(User $admin): void
    {
        $this->update([
            'status' => MembershipStatus::Approved,
            'approved_by' => $admin->id,
            'approved_at' => now(),
        ]);
    }

    public function reject(User $admin): void
    {
        $this->update([
            'status' => MembershipStatus::Rejected,
            'approved_by' => $admin->id,
            'approved_at' => now(),
        ]);
    }
}
