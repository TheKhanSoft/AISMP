@props([
    'color' => 'primary',
    'size' => 'md',
    'dot' => false,
])

@php
    $baseClasses = 'inline-flex items-center font-medium rounded-full';
    
    $sizeClasses = match($size) {
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-0.5 text-sm',
        'lg' => 'px-3 py-1 text-base',
        default => 'px-2.5 py-0.5 text-sm',
    };

    $colorClasses = match($color) {
        'primary' => 'bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300',
        'secondary' => 'bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300',
        'success' => 'bg-success-50 text-success-700 dark:bg-success-900/30 dark:text-success-400',
        'danger' => 'bg-danger-50 text-danger-700 dark:bg-danger-900/30 dark:text-danger-400',
        'warning' => 'bg-warning-50 text-warning-800 dark:bg-warning-900/30 dark:text-warning-400',
        'info' => 'bg-info-50 text-info-700 dark:bg-info-900/30 dark:text-info-400',
        'accent' => 'bg-accent-50 text-accent-700 dark:bg-accent-900/30 dark:text-accent-400',
        'neural' => 'bg-neural-50 text-neural-700 dark:bg-neural-900/30 dark:text-neural-400',
        default => 'bg-primary-100 text-primary-800',
    };

    $dotColorClass = match($color) {
        'primary' => 'bg-primary-500',
        'secondary' => 'bg-slate-500',
        'success' => 'bg-success-500',
        'danger' => 'bg-danger-500',
        'warning' => 'bg-warning-500',
        'info' => 'bg-info-500',
        'accent' => 'bg-accent-500',
        'neural' => 'bg-neural-500',
        default => 'bg-primary-500',
    };
@endphp

<span {{ $attributes->merge(['class' => "{$baseClasses} {$sizeClasses} {$colorClasses}"]) }}>
    @if($dot)
        <svg class="mr-1.5 h-2 w-2 text-current" fill="currentColor" viewBox="0 0 8 8">
            <circle cx="4" cy="4" r="3" class="{{ $dotColorClass }}"></circle>
        </svg>
    @endif
    {{ $slot }}
</span>
