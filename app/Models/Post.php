<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Traits\HasSlug;
use App\Traits\HasSeo;
use App\Traits\Publishable;

class Post extends Model
{
    use SoftDeletes, HasSlug, HasSeo, Publishable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image_url',
        'is_featured',
        'is_published',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
