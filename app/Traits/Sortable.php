<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order');
    }

    public function moveUp(): void
    {
        $previous = static::where('order', '<', $this->order)->orderBy('order', 'desc')->first();
        if ($previous) {
            $temp = $this->order;
            $this->update(['order' => $previous->order]);
            $previous->update(['order' => $temp]);
        }
    }

    public function moveDown(): void
    {
        $next = static::where('order', '>', $this->order)->orderBy('order', 'asc')->first();
        if ($next) {
            $temp = $this->order;
            $this->update(['order' => $next->order]);
            $next->update(['order' => $temp]);
        }
    }
}
