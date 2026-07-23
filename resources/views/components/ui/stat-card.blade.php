@props([
    'title',
    'value',
    'change' => null,
    'changeType' => 'up',
    'icon' => null,
    'color' => 'primary',
])

@php
    $iconColors = match($color) {
        'primary' => 'bg-primary-100 text-primary-600 dark:bg-primary-900/50 dark:text-primary-400',
        'accent' => 'bg-accent-100 text-accent-600 dark:bg-accent-900/50 dark:text-accent-400',
        'neural' => 'bg-neural-100 text-neural-600 dark:bg-neural-900/50 dark:text-neural-400',
        'success' => 'bg-success-100 text-success-600 dark:bg-success-900/50 dark:text-success-400',
        'warning' => 'bg-warning-100 text-warning-600 dark:bg-warning-900/50 dark:text-warning-400',
        'danger' => 'bg-danger-100 text-danger-600 dark:bg-danger-900/50 dark:text-danger-400',
        default => 'bg-primary-100 text-primary-600',
    };

    $changeColors = match($changeType) {
        'up' => 'text-success-600 dark:text-success-400',
        'down' => 'text-danger-600 dark:text-danger-400',
        'neutral' => 'text-slate-500 dark:text-slate-400',
        default => 'text-success-600 dark:text-success-400',
    };
@endphp

<div class="glass-card p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 truncate">
                {{ $title }}
            </p>
            <p class="mt-2 text-3xl font-semibold text-slate-900 dark:text-white">
                {{ $value }}
            </p>
        </div>
        
        @if($icon)
            <div class="flex items-center justify-center w-12 h-12 rounded-lg {{ $iconColors }}">
                {!! $icon !!}
            </div>
        @endif
    </div>
    
    @if($change)
        <div class="mt-4 flex items-center text-sm">
            @if($changeType === 'up')
                <svg class="flex-shrink-0 self-center w-4 h-4 text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            @elseif($changeType === 'down')
                <svg class="flex-shrink-0 self-center w-4 h-4 text-danger-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            @endif
            <span class="ml-1 font-medium {{ $changeColors }}">
                {{ $change }}
            </span>
            <span class="ml-2 text-slate-500 dark:text-slate-400">
                from last period
            </span>
        </div>
    @endif
</div>
