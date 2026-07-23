<?php

declare(strict_types=1);

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        })[$key] ?? $default;
    }
}

if (!function_exists('settings_group')) {
    function settings_group(string $group): array
    {
        $settings = Cache::rememberForever('settings', function () {
            return Setting::all()->groupBy('group')->map(function ($items) {
                return $items->pluck('value', 'key')->toArray();
            })->toArray();
        });
        return $settings[$group] ?? [];
    }
}

if (!function_exists('clear_settings_cache')) {
    function clear_settings_cache(): void
    {
        Cache::forget('settings');
    }
}
