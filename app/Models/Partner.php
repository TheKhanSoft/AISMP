<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class Partner extends Model
{
    use Sortable;

    protected $fillable = [
        'name',
        'logo_url',
        'website_url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
