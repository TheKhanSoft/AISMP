@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'fullWidth' => false,
    'disabled' => false,
    'loading' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-slate-900 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $sizeClasses = match($size) {
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm leading-4',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
        default => 'px-4 py-2 text-sm',
    };

    $variantClasses = match($variant) {
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500 border border-transparent shadow-sm',
        'secondary' => 'bg-slate-100 text-slate-700 hover:bg-slate-200 focus:ring-slate-500 border border-transparent dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700 shadow-sm',
        'danger' => 'bg-danger-600 text-white hover:bg-danger-700 focus:ring-danger-500 border border-transparent shadow-sm',
        'success' => 'bg-success-600 text-white hover:bg-success-700 focus:ring-success-500 border border-transparent shadow-sm',
        'warning' => 'bg-warning-500 text-white hover:bg-warning-600 focus:ring-warning-500 border border-transparent shadow-sm',
        'info' => 'bg-info-600 text-white hover:bg-info-700 focus:ring-info-500 border border-transparent shadow-sm',
        'outline' => 'bg-transparent text-slate-700 border border-slate-300 hover:bg-slate-50 focus:ring-primary-500 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-800 shadow-sm',
        'ghost' => 'bg-transparent text-slate-700 hover:bg-slate-100 focus:ring-slate-500 dark:text-slate-300 dark:hover:bg-slate-800',
        default => 'bg-primary-600 text-white hover:bg-primary-700',
    };

    $widthClass = $fullWidth ? 'w-full' : '';
    
    $classes = "{$baseClasses} {$sizeClasses} {$variantClasses} {$widthClass}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'left')
            <span class="mr-2 -ml-1 flex-shrink-0 w-4 h-4">{!! $icon !!}</span>
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            <span class="ml-2 -mr-1 flex-shrink-0 w-4 h-4">{!! $icon !!}</span>
        @endif
    </a>
@else
    <button type="{{ $type }}" @if($disabled || $loading) disabled @endif {{ $attributes->merge(['class' => $classes]) }}>
        @if($loading)
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @elseif($icon && $iconPosition === 'left')
            <span class="mr-2 -ml-1 flex-shrink-0 w-4 h-4">{!! $icon !!}</span>
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            <span class="ml-2 -mr-1 flex-shrink-0 w-4 h-4">{!! $icon !!}</span>
        @endif
    </button>
@endif
