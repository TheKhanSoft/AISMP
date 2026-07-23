<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;
use App\Traits\HasSeo;
use App\Traits\Publishable;

class Page extends Model
{
    use SoftDeletes, HasSlug, HasSeo, Publishable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
