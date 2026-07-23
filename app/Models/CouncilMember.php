<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class CouncilMember extends Model
{
    use Sortable;

    protected $fillable = [
        'name',
        'role',
        'bio',
        'image_url',
        'linkedin_url',
        'twitter_url',
        'is_active',
        'term_start',
        'term_end',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'term_start' => 'date',
        'term_end' => 'date',
        'order' => 'integer',
    ];
}
