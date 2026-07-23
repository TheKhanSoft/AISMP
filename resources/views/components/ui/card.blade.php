@props([
    'glass' => false,
    'padding' => 'md',
    'hover' => false,
])

@php
    $baseClasses = 'bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700';
    
    if ($glass) {
        $baseClasses = 'glass-card';
    }

    if ($hover) {
        $baseClasses .= ' transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg dark:hover:shadow-slate-700/30';
    } else {
        $baseClasses .= ' shadow-sm';
    }

    $paddingClasses = match($padding) {
        'none' => '',
        'sm' => 'p-3 sm:p-4',
        'md' => 'p-4 sm:p-6',
        'lg' => 'p-6 sm:p-8',
        default => 'p-4 sm:p-6',
    };
@endphp

<div {{ $attributes->merge(['class' => $baseClasses]) }}>
    @if(isset($header))
        <div class="px-4 py-5 sm:px-6 border-b border-slate-200 dark:border-slate-700">
            {{ $header }}
        </div>
    @endif

    <div class="{{ $paddingClasses }}">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-4 py-4 sm:px-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-700">
            {{ $footer }}
        </div>
    @endif
</div>
