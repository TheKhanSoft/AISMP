<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\RegistrationStatus;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'registered_at',
    ];

    protected $casts = [
        'status' => RegistrationStatus::class,
        'registered_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
