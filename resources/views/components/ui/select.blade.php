@props([
    'label' => '',
    'name' => '',
    'options' => [],
    'value' => '',
    'error' => null,
    'hint' => '',
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Select an option',
])

@php
    $hasError = $error ?? $errors->has($name);
    
    $baseClasses = 'block w-full rounded-lg border-0 py-2 pl-3 pr-10 text-slate-900 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 dark:bg-slate-800 dark:text-white transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-slate-50 dark:disabled:bg-slate-900 appearance-none bg-no-repeat';
    
    if ($hasError) {
        $baseClasses .= ' ring-danger-300 dark:ring-danger-500/50 focus:ring-danger-500';
    } else {
        $baseClasses .= ' ring-slate-300 dark:ring-slate-700 focus:ring-primary-600 dark:focus:ring-primary-500';
    }

    $bgImageLight = "url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e\")";
    $bgImageDark = "url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e\")";
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
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            {{ $attributes->merge(['class' => $baseClasses]) }}
            style="background-image: {{ $bgImageLight }}; background-position: right 0.5rem center; background-size: 1.5em 1.5em;"
            x-data
            x-bind:style="$store.darkMode.on ? 'background-image: {{ $bgImageDark }}; background-position: right 0.5rem center; background-size: 1.5em 1.5em;' : 'background-image: {{ $bgImageLight }}; background-position: right 0.5rem center; background-size: 1.5em 1.5em;'"
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            
            @foreach($options as $key => $optionValue)
                <option value="{{ is_array($options) ? $key : $optionValue }}" @selected($value == (is_array($options) ? $key : $optionValue))>
                    {{ $optionValue }}
                </option>
            @endforeach
            {{ $slot }}
        </select>
    </div>

    @if($hasError)
        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $error ?? $errors->first($name) }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $hint }}</p>
    @endif
</div>
