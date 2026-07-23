<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'is_verified',
        'verified_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];
}
