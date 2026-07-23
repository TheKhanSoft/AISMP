@props([
    'label' => '',
    'name' => '',
    'accept' => '*/*',
    'multiple' => false,
    'maxSize' => '5MB',
    'error' => null,
])

@php
    $hasError = $error ?? $errors->has($name);
@endphp

<div class="w-full" x-data="{ files: null }" @dragover.prevent="$el.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/10')" @dragleave.prevent="$el.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/10')" @drop.prevent="$el.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/10'); files = $event.dataTransfer.files; $refs.fileInput.files = files; $refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }));">
    
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium leading-6 text-slate-900 dark:text-slate-200 mb-2">
            {{ $label }}
        </label>
    @endif

    <div class="mt-2 flex justify-center rounded-lg border border-dashed {{ $hasError ? 'border-danger-300 dark:border-danger-500' : 'border-slate-300 dark:border-slate-600' }} px-6 py-10 transition-colors duration-200 hover:border-primary-500 hover:bg-slate-50 dark:hover:bg-slate-800/50">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-slate-300 dark:text-slate-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
            </svg>
            
            <div class="mt-4 flex text-sm leading-6 text-slate-600 dark:text-slate-400 justify-center">
                <label for="{{ $name }}" class="relative cursor-pointer rounded-md bg-white dark:bg-slate-800 font-semibold text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-600 focus-within:ring-offset-2 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                    <span>Upload a file</span>
                    <input 
                        x-ref="fileInput"
                        id="{{ $name }}" 
                        name="{{ $name }}" 
                        type="file" 
                        class="sr-only" 
                        accept="{{ $accept }}"
                        @if($multiple) multiple @endif
                        @change="files = $event.target.files"
                        {{ $attributes->whereStartsWith('wire:model') }}
                    >
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            
            <p class="text-xs leading-5 text-slate-500 dark:text-slate-400 mt-1">Up to {{ $maxSize }}</p>
        </div>
    </div>
    
    <div x-show="files !== null && files.length > 0" class="mt-4 space-y-2" style="display: none;">
        <template x-for="file in files" :key="file.name">
            <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-200 dark:border-slate-700">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200" x-text="file.name"></span>
                </div>
                <span class="text-xs text-slate-500 dark:text-slate-400" x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'"></span>
            </div>
        </template>
    </div>

    @if($hasError)
        <p class="mt-2 text-sm text-danger-600 dark:text-danger-400">{{ $error ?? $errors->first($name) }}</p>
    @endif
</div>
