<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-neural-900 dark:text-neural-100">Hero Slides</h1>
            <p class="text-sm text-neural-500 dark:text-neural-400">Manage homepage carousel slides.</p>
        </div>
        <x-ui.button wire:navigate href="{{ route('admin.homepage.hero-slides.create') }}" variant="primary">
            Add New Slide
        </x-ui.button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($slides as $index => $slide)
            <x-ui.card class="overflow-hidden relative group">
                <!-- Image Preview -->
                <div class="h-48 w-full bg-neural-100 dark:bg-neural-800 relative">
                    @if($slide->hasMedia('image'))
                        <img src="{{ $slide->getFirstMediaUrl('image', 'thumb') }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center w-full h-full text-neural-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-3 left-3">
                        <button wire:click="toggleActive({{ $slide->id }})" class="focus:outline-none">
                            <x-ui.badge variant="{{ $slide->is_active ? 'success' : 'neural' }}">
                                {{ $slide->is_active ? 'Active' : 'Inactive' }}
                            </x-ui.badge>
                        </button>
                    </div>

                    <!-- Order Controls -->
                    <div class="absolute top-3 right-3 flex flex-col gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button wire:click="moveUp({{ $slide->id }})" @if($loop->first) disabled @endif class="bg-white/80 dark:bg-black/50 hover:bg-white dark:hover:bg-black p-1.5 rounded text-neural-700 dark:text-neural-300 disabled:opacity-50 shadow-sm backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                        </button>
                        <button wire:click="moveDown({{ $slide->id }})" @if($loop->last) disabled @endif class="bg-white/80 dark:bg-black/50 hover:bg-white dark:hover:bg-black p-1.5 rounded text-neural-700 dark:text-neural-300 disabled:opacity-50 shadow-sm backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="font-medium text-lg text-neural-900 dark:text-white truncate" title="{{ $slide->title }}">
                        {{ $slide->title ?? 'Untitled Slide' }}
                    </h3>
                    <p class="text-sm text-neural-500 mt-1 truncate">
                        {{ $slide->subtitle ?? 'No subtitle' }}
                    </p>
                    
                    <div class="mt-4 flex justify-between items-center border-t border-neural-100 dark:border-neural-700 pt-4">
                        <x-ui.button size="sm" variant="secondary" wire:navigate href="{{ route('admin.homepage.hero-slides.edit', $slide->id) }}">
                            Edit Slide
                        </x-ui.button>
                        <x-ui.button size="sm" variant="danger" wire:click="deleteSlide({{ $slide->id }})" wire:confirm="Delete this slide completely?">
                            Delete
                        </x-ui.button>
                    </div>
                </div>
            </x-ui.card>
        @empty
            <div class="col-span-full py-12 text-center bg-white dark:bg-neural-900 rounded-lg border border-dashed border-neural-300 dark:border-neural-700">
                <svg class="mx-auto h-12 w-12 text-neural-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-neural-900 dark:text-white">No slides</h3>
                <p class="mt-1 text-sm text-neural-500 dark:text-neural-400">Get started by creating a new hero slide.</p>
                <div class="mt-6">
                    <x-ui.button wire:navigate href="{{ route('admin.homepage.hero-slides.create') }}">
                        Add New Slide
                    </x-ui.button>
                </div>
            </div>
        @endforelse
    </div>
</div>
