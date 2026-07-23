@props([
    'title',
    'description' => '',
    'icon' => null,
])

<div {{ $attributes->merge(['class' => 'text-center p-12 glass-card border border-dashed border-slate-300 dark:border-slate-700']) }}>
    @if($icon)
        <div class="mx-auto flex items-center justify-center h-12 w-12 text-slate-400 dark:text-slate-500 mb-4">
            {!! $icon !!}
        </div>
    @else
        <svg class="mx-auto h-12 w-12 text-slate-400 dark:text-slate-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
        </svg>
    @endif

    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ $title }}</h3>
    
    @if($description)
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $description }}</p>
    @endif

    @if(isset($action))
        <div class="mt-6">
            {{ $action }}
        </div>
    @endif
</div>
