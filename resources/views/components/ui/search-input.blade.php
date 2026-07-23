@props([
    'placeholder' => 'Search...',
])

<div class="relative w-full max-w-md">
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
        </svg>
    </div>
    <input 
        type="search"
        {{ $attributes->whereStartsWith('wire:model') }}
        @if($attributes->has('wire:model')) wire:model.live.debounce.300ms="{{ $attributes->get('wire:model') }}" @endif
        class="block w-full rounded-lg border-0 py-2 pl-10 pr-3 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6 dark:bg-slate-800 dark:text-slate-200 dark:ring-slate-700 dark:focus:ring-primary-500"
        placeholder="{{ $placeholder }}"
    >
</div>
