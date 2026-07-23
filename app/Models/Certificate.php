<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'certificable_id',
        'certificable_type',
        'certificate_number',
        'issued_at',
        'expires_at',
        'metadata',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'expires_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function certificable(): MorphTo
    {
        return $this->morphTo();
    }
}
