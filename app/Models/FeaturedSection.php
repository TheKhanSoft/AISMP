<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedSection extends Model
{
    protected $fillable = [
        'title',
        'identifier',
        'content',
        'settings',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];
}
