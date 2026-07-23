<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Sortable;

class Menu extends Model
{
    use Sortable;

    protected $fillable = [
        'name',
        'location',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
