<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function scopeGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
