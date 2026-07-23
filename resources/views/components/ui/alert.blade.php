@props([
    'type' => 'info',
    'dismissible' => false,
    'icon' => true,
])

@php
    $baseClasses = 'rounded-lg p-4 mb-4 border';
    
    $typeClasses = match($type) {
        'success' => 'bg-success-50 border-success-200 text-success-800 dark:bg-success-900/20 dark:border-success-900/50 dark:text-success-400',
        'error' => 'bg-danger-50 border-danger-200 text-danger-800 dark:bg-danger-900/20 dark:border-danger-900/50 dark:text-danger-400',
        'warning' => 'bg-warning-50 border-warning-200 text-warning-800 dark:bg-warning-900/20 dark:border-warning-900/50 dark:text-warning-400',
        'info' => 'bg-info-50 border-info-200 text-info-800 dark:bg-info-900/20 dark:border-info-900/50 dark:text-info-400',
        default => 'bg-info-50 border-info-200 text-info-800',
    };
@endphp

<div x-data="{ show: true }" x-show="show" x-transition {{ $attributes->merge(['class' => "{$baseClasses} {$typeClasses}"]) }} role="alert">
    <div class="flex items-start">
        @if($icon)
            <div class="flex-shrink-0">
                @if($type === 'success')
                    <svg class="h-5 w-5 text-success-400 dark:text-success-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @elseif($type === 'error')
                    <svg class="h-5 w-5 text-danger-400 dark:text-danger-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @elseif($type === 'warning')
                    <svg class="h-5 w-5 text-warning-400 dark:text-warning-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                @else
                    <svg class="h-5 w-5 text-info-400 dark:text-info-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @endif
            </div>
        @endif

        <div class="ml-3 flex-1">
            <div class="text-sm font-medium">
                {{ $slot }}
            </div>
        </div>

        @if($dismissible)
            <div class="ml-auto pl-3">
                <button @click="show = false" type="button" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 opacity-50 hover:opacity-100 transition-opacity">
                    <span class="sr-only">Dismiss</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>
