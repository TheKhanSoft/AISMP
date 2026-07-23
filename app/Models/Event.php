<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasSlug;
use App\Traits\HasSeo;
use App\Traits\Publishable;
use App\Enums\EventType;
use App\Enums\EventStatus;

class Event extends Model
{
    use SoftDeletes, HasSlug, HasSeo, Publishable;

    protected $fillable = [
        'created_by',
        'title',
        'slug',
        'description',
        'content',
        'type',
        'status',
        'is_online',
        'location',
        'link',
        'start_date',
        'end_date',
        'registration_deadline',
        'fee',
        'capacity',
        'image_url',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'type' => EventType::class,
        'status' => EventStatus::class,
        'is_online' => 'boolean',
        'is_published' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'published_at' => 'datetime',
        'fee' => 'decimal:2',
        'capacity' => 'integer',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(EventAttendance::class);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('start_date', '>', now());
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('end_date', '<', now());
    }

    public function scopeOfType(Builder $query, EventType $type): Builder
    {
        return $query->where('type', $type);
    }

    public function isRegistrationOpen(): bool
    {
        if (!$this->registration_deadline) {
            return $this->start_date > now();
        }
        return $this->registration_deadline > now();
    }

    public function registeredCount(): int
    {
        return $this->registrations()->count();
    }

    public function isFull(): bool
    {
        if (!$this->capacity) {
            return false;
        }
        return $this->registeredCount() >= $this->capacity;
    }
}
