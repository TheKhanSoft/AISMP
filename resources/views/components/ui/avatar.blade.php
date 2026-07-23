@props([
    'src' => null,
    'alt' => '',
    'size' => 'md',
    'initials' => '',
    'status' => null,
])

@php
    $sizeClasses = match($size) {
        'xs' => 'h-6 w-6 text-xs',
        'sm' => 'h-8 w-8 text-sm',
        'md' => 'h-10 w-10 text-base',
        'lg' => 'h-12 w-12 text-lg',
        'xl' => 'h-14 w-14 text-xl',
        default => 'h-10 w-10 text-base',
    };

    $statusClasses = match($status) {
        'online' => 'bg-success-500',
        'offline' => 'bg-slate-400',
        'away' => 'bg-warning-500',
        'busy' => 'bg-danger-500',
        default => 'bg-slate-400',
    };
    
    $statusSizeClasses = match($size) {
        'xs' => 'h-1.5 w-1.5',
        'sm' => 'h-2 w-2',
        'md' => 'h-2.5 w-2.5',
        'lg' => 'h-3 w-3',
        'xl' => 'h-3.5 w-3.5',
        default => 'h-2.5 w-2.5',
    };
@endphp

<div class="relative inline-block">
    @if($src)
        <img class="{{ $sizeClasses }} rounded-full object-cover" src="{{ $src }}" alt="{{ $alt }}">
    @else
        <span class="{{ $sizeClasses }} inline-flex items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/50">
            <span class="font-medium leading-none text-primary-700 dark:text-primary-300">{{ $initials }}</span>
        </span>
    @endif
    
    @if($status)
        <span class="absolute bottom-0 right-0 block rounded-full ring-2 ring-white dark:ring-slate-900 {{ $statusSizeClasses }} {{ $statusClasses }}"></span>
    @endif
</div>
