<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Traits\HasSlug;

class Tag extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function news(): MorphToMany
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
