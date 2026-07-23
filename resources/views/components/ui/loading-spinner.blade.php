@props([
    'size' => 'md',
    'color' => 'primary',
])

@php
    $sizeClasses = match($size) {
        'sm' => 'h-4 w-4 border-2',
        'md' => 'h-8 w-8 border-3',
        'lg' => 'h-12 w-12 border-4',
        default => 'h-8 w-8 border-3',
    };

    $colorClasses = match($color) {
        'primary' => 'border-primary-500 border-t-transparent',
        'white' => 'border-white border-t-transparent',
        'slate' => 'border-slate-500 border-t-transparent dark:border-slate-400 dark:border-t-transparent',
        'success' => 'border-success-500 border-t-transparent',
        'danger' => 'border-danger-500 border-t-transparent',
        default => 'border-primary-500 border-t-transparent',
    };
@endphp

<div {{ $attributes->merge(['class' => "animate-spin rounded-full {$sizeClasses} {$colorClasses}"]) }} role="status">
    <span class="sr-only">Loading...</span>
</div>
