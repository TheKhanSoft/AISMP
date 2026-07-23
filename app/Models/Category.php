<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasSlug;

class Category extends Model
{
    use SoftDeletes, HasSlug;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'type',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
