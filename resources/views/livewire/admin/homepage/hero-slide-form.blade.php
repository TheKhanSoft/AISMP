<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-neural-900 dark:text-neural-100">
            {{ $slideId ? 'Edit Slide' : 'Create Slide' }}
        </h1>
        <div class="flex gap-3">
            <x-ui.button wire:navigate variant="secondary" href="{{ route('admin.homepage.hero-slides.index') }}">Cancel</x-ui.button>
            <x-ui.button wire:click="save">
                <span wire:loading.remove wire:target="save">Save Slide</span>
                <span wire:loading wire:target="save">Saving...</span>
            </x-ui.button>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <x-ui.card>
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Slide Title <span class="text-danger-500">*</span></label>
                            <x-ui.input wire:model="title" class="w-full text-lg" placeholder="Main heading text" />
                            @error('title') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Subtitle</label>
                            <textarea wire:model="subtitle" rows="2" class="w-full rounded-md border-neural-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-neural-900 dark:border-neural-700 dark:text-white" placeholder="Secondary text below heading"></textarea>
                            @error('subtitle') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Button Text</label>
                                <x-ui.input wire:model="button_text" class="w-full" placeholder="e.g. Learn More" />
                                @error('button_text') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Button URL</label>
                                <x-ui.input wire:model="button_url" class="w-full" placeholder="https://..." />
                                @error('button_url') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            <div class="space-y-6">
                <x-ui.card>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-neural-900 dark:text-white border-b border-neural-200 dark:border-neural-700 pb-2 mb-4">Slide Image</h3>
                        
                        @if ($image)
                            <div class="mb-4 relative">
                                <img src="{{ $image->temporaryUrl() }}" class="w-full rounded-lg object-cover h-48">
                                <button type="button" wire:click="$set('image', null)" class="absolute top-2 right-2 bg-danger-500 text-white rounded-full p-1 shadow-sm hover:bg-danger-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        @elseif ($current_image_url)
                            <div class="mb-4 relative">
                                <img src="{{ $current_image_url }}" class="w-full rounded-lg object-cover h-48">
                            </div>
                        @endif

                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-neural-300 border-dashed rounded-lg cursor-pointer bg-neural-50 dark:hover:bg-neural-800 dark:bg-neural-900 hover:bg-neural-100 dark:border-neural-600 dark:hover:border-neural-500">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-neural-500 dark:text-neural-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-neural-500 dark:text-neural-400"><span class="font-semibold">Upload Image</span></p>
                                </div>
                                <input type="file" wire:model="image" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        <div wire:loading wire:target="image" class="mt-2 text-sm text-primary-600">Uploading...</div>
                        @error('image') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </x-ui.card>

                <x-ui.card>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-neural-900 dark:text-white border-b border-neural-200 dark:border-neural-700 pb-2 mb-4">Settings</h3>
                        
                        <div class="flex items-center">
                            <input wire:model="is_active" type="checkbox" id="is_active" class="h-4 w-4 rounded border-neural-300 text-primary-600 focus:ring-primary-500 dark:border-neural-600 dark:bg-neural-900 dark:ring-offset-neural-900">
                            <label for="is_active" class="ml-2 block text-sm text-neural-900 dark:text-neural-300">
                                Set as Active
                            </label>
                        </div>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </form>
</div>
