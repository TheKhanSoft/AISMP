<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Publishable
{
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->where(function($q) {
            $q->whereNull('published_at')->orWhere('published_at', '<=', now());
        });
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('is_published', false);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function publish(): void
    {
        $this->update([
            'is_published' => true,
            'published_at' => $this->published_at ?? now(),
        ]);
    }

    public function unpublish(): void
    {
        $this->update([
            'is_published' => false,
        ]);
    }
}
