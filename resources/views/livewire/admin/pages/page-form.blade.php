<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-neural-900 dark:text-neural-100">
            {{ $pageId ? 'Edit Page' : 'Create Page' }}
        </h1>
        <div class="flex gap-3">
            <x-ui.button wire:navigate variant="secondary" href="{{ route('admin.pages.index') }}">Cancel</x-ui.button>
            <x-ui.button wire:click="save">
                <span wire:loading.remove wire:target="save">Save Page</span>
                <span wire:loading wire:target="save">Saving...</span>
            </x-ui.button>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-6">
                <x-ui.card>
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Page Title <span class="text-danger-500">*</span></label>
                            <x-ui.input wire:model.live="title" placeholder="Enter page title" class="w-full text-lg" />
                            @error('title') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">URL Slug <span class="text-danger-500">*</span></label>
                            <div class="flex rounded-md shadow-sm">
                                <span class="inline-flex items-center rounded-l-md border border-r-0 border-neural-300 bg-neural-50 px-3 text-neural-500 sm:text-sm dark:bg-neural-800 dark:border-neural-600 dark:text-neural-400">
                                    {{ url('/') }}/
                                </span>
                                <x-ui.input wire:model="slug" class="rounded-none rounded-r-md flex-1" />
                            </div>
                            @error('slug') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div wire:ignore>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Content</label>
                            <!-- Assuming x-rich-text component exists or initializing a JS editor via Alpine -->
                            <div x-data x-init="
                                ClassicEditor.create($refs.editor)
                                    .then(editor => {
                                        editor.model.document.on('change:data', () => {
                                            @this.set('content', editor.getData());
                                        })
                                    })
                                    .catch(error => { console.error(error); });
                            ">
                                <textarea x-ref="editor" wire:model="content" class="w-full min-h-[400px] border-neural-300 rounded-md"></textarea>
                            </div>
                            @error('content') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Excerpt</label>
                            <textarea wire:model="excerpt" rows="3" class="w-full rounded-md border-neural-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-neural-900 dark:border-neural-700 dark:text-white" placeholder="Brief description of the page"></textarea>
                            @error('excerpt') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </x-ui.card>

                <!-- SEO Section -->
                <x-ui.card x-data="{ open: false }">
                    <div class="p-6">
                        <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                            <h3 class="text-lg font-medium text-neural-900 dark:text-white">Search Engine Optimization</h3>
                            <svg class="h-5 w-5 text-neural-500 transition-transform" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                        
                        <div x-show="open" x-transition class="mt-4 space-y-4 pt-4 border-t border-neural-200 dark:border-neural-700">
                            <div>
                                <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Meta Title</label>
                                <x-ui.input wire:model="meta_title" class="w-full" placeholder="Leave empty to use page title" />
                                @error('meta_title') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Meta Description</label>
                                <textarea wire:model="meta_description" rows="3" class="w-full rounded-md border-neural-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-neural-900 dark:border-neural-700 dark:text-white"></textarea>
                                @error('meta_description') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Meta Keywords</label>
                                <x-ui.input wire:model="meta_keywords" class="w-full" placeholder="keyword1, keyword2" />
                                @error('meta_keywords') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <x-ui.card>
                    <div class="p-6 space-y-4">
                        <h3 class="text-lg font-medium text-neural-900 dark:text-white border-b border-neural-200 dark:border-neural-700 pb-2">Publish Settings</h3>
                        
                        <div class="flex items-center mt-4">
                            <input wire:model="is_published" type="checkbox" id="is_published" class="h-4 w-4 rounded border-neural-300 text-primary-600 focus:ring-primary-500 dark:border-neural-600 dark:bg-neural-900 dark:ring-offset-neural-900">
                            <label for="is_published" class="ml-2 block text-sm text-neural-900 dark:text-neural-300">
                                Publish this page
                            </label>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300 mb-1">Template</label>
                            <select wire:model="template" class="w-full rounded-md border-neural-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-neural-900 dark:border-neural-700 dark:text-white">
                                <option value="default">Default Template</option>
                                <option value="full-width">Full Width</option>
                                <option value="blank">Blank Template</option>
                            </select>
                            @error('template') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </x-ui.card>

                <x-ui.card>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-neural-900 dark:text-white border-b border-neural-200 dark:border-neural-700 pb-2 mb-4">Featured Image</h3>
                        
                        @if ($featured_image)
                            <div class="mb-4 relative">
                                <img src="{{ $featured_image->temporaryUrl() }}" class="w-full rounded-lg object-cover h-48">
                                <button type="button" wire:click="$set('featured_image', null)" class="absolute top-2 right-2 bg-danger-500 text-white rounded-full p-1 shadow-sm hover:bg-danger-600">
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
                                    <p class="mb-2 text-sm text-neural-500 dark:text-neural-400"><span class="font-semibold">Click to upload</span></p>
                                </div>
                                <input type="file" wire:model="featured_image" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        <div wire:loading wire:target="featured_image" class="mt-2 text-sm text-primary-600">Uploading...</div>
                        @error('featured_image') <span class="text-danger-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </x-ui.card>
            </div>
        </div>
    </form>
</div>
