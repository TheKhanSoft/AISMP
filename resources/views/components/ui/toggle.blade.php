@props([
    'label' => '',
    'name' => '',
    'description' => '',
    'checked' => false,
    'disabled' => false,
])

<div class="flex items-center justify-between" x-data="{ checked: @js($checked) }">
    <div class="flex flex-col">
        @if($label)
            <label for="{{ $name }}" class="text-sm font-medium text-slate-900 dark:text-slate-200 cursor-pointer" @click="if(!{{ $disabled ? 'true' : 'false' }}) checked = !checked">
                {{ $label }}
            </label>
        @endif
        @if($description)
            <span class="text-sm text-slate-500 dark:text-slate-400">
                {{ $description }}
            </span>
        @endif
    </div>

    <button
        type="button"
        role="switch"
        :aria-checked="checked.toString()"
        @click="checked = !checked"
        @if($disabled) disabled @endif
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        @if($attributes->has('wire:model'))
            x-on:click="$wire.set('{{ $attributes->get('wire:model') }}', checked)"
        @endif
        :class="{ 'bg-primary-600': checked, 'bg-slate-200 dark:bg-slate-700': !checked }"
        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:focus:ring-offset-slate-900 {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
    >
        <span class="sr-only">Toggle {{ $label }}</span>
        <span
            :class="{ 'translate-x-5': checked, 'translate-x-0': !checked }"
            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
        ></span>
    </button>
    
    @if($name && !$attributes->has('wire:model'))
        <input type="hidden" name="{{ $name }}" :value="checked ? 1 : 0">
    @endif
</div>
