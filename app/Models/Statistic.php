<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class Statistic extends Model
{
    use Sortable;

    protected $fillable = [
        'label',
        'value',
        'icon',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'value' => 'integer',
        'order' => 'integer',
    ];
}
