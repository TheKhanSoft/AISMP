<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class CallToAction extends Model
{
    use Sortable;

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_url',
        'background_image_url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
