<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class HeroSlide extends Model
{
    use Sortable;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image_url',
        'button_text',
        'button_url',
        'is_active',
        'order',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
