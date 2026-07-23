<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class Testimonial extends Model
{
    use Sortable;

    protected $fillable = [
        'name',
        'position',
        'company',
        'content',
        'avatar_url',
        'rating',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
        'order' => 'integer',
    ];
}
