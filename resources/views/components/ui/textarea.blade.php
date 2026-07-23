@props([
    'label' => '',
    'name' => '',
    'rows' => 4,
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'hint' => '',
    'required' => false,
    'disabled' => false,
])

@php
    $hasError = $error ?? $errors->has($name);
    
    $baseClasses = 'block w-full rounded-lg border-0 py-2 text-slate-900 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 dark:bg-slate-800 dark:text-white transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-slate-50 dark:disabled:bg-slate-900';
    
    if ($hasError) {
        $baseClasses .= ' ring-danger-300 dark:ring-danger-500/50 focus:ring-danger-500 placeholder:text-danger-300 dark:placeholder:text-danger-600';
    } else {
        $baseClasses .= ' ring-slate-300 dark:ring-slate-700 focus:ring-primary-600 dark:focus:ring-primary-500 placeholder:text-slate-400 dark:placeholder:text-slate-500';
    }
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium leading-6 text-slate-900 dark:text-slate-200 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-danger-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative rounded-md shadow-sm">
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            rows="{{ $rows }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            {{ $attributes->merge(['class' => $baseClasses]) }}
        >{{ $value ?? $slot }}</textarea>

        @if($hasError)
            <div class="pointer-events-none absolute top-2 right-0 flex items-center pr-3">
                <svg class="h-5 w-5 text-danger-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            </div>
        @endif
    </div>

    @if($hasError)
        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $error ?? $errors->first($name) }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $hint }}</p>
    @endif
</div>
