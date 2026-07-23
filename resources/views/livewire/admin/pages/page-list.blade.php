<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-neural-900 dark:text-neural-100">Pages</h1>
            <p class="text-sm text-neural-500 dark:text-neural-400">Manage your website's static pages.</p>
        </div>
        <x-ui.button wire:navigate href="{{ route('admin.pages.create') }}" variant="primary">
            Create Page
        </x-ui.button>
    </div>

    <x-ui.card>
        <div class="p-4 flex flex-col md:flex-row gap-4 justify-between border-b border-neural-200 dark:border-neural-700">
            <div class="w-full md:w-1/3">
                <x-ui.input wire:model.live.debounce.300ms="search" placeholder="Search pages..." type="search" />
            </div>
            <div class="w-full md:w-48">
                <select wire:model.live="status" class="w-full rounded-md border-neural-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-neural-800 dark:border-neural-600 dark:text-white">
                    <option value="">All Statuses</option>
                    <option value="1">Published</option>
                    <option value="0">Draft</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto relative">
            <div wire:loading class="absolute inset-0 bg-white/50 dark:bg-neural-900/50 z-10"></div>
            <x-ui.table>
                <x-slot:head>
                    <x-ui.table.row>
                        <x-ui.table.heading>Title</x-ui.table.heading>
                        <x-ui.table.heading>URL Slug</x-ui.table.heading>
                        <x-ui.table.heading>Status</x-ui.table.heading>
                        <x-ui.table.heading>Created</x-ui.table.heading>
                        <x-ui.table.heading class="text-right">Actions</x-ui.table.heading>
                    </x-ui.table.row>
                </x-slot:head>
                <x-slot:body>
                    @forelse($pages as $page)
                        <x-ui.table.row wire:key="page-{{ $page->id }}">
                            <x-ui.table.cell class="font-medium text-neural-900 dark:text-white">
                                {{ $page->title }}
                            </x-ui.table.cell>
                            <x-ui.table.cell class="text-neural-500">
                                /{{ $page->slug }}
                            </x-ui.table.cell>
                            <x-ui.table.cell>
                                <button wire:click="togglePublish({{ $page->id }})" class="focus:outline-none">
                                    <x-ui.badge variant="{{ $page->is_published ? 'success' : 'warning' }}">
                                        {{ $page->is_published ? 'Published' : 'Draft' }}
                                    </x-ui.badge>
                                </button>
                            </x-ui.table.cell>
                            <x-ui.table.cell class="text-neural-500 whitespace-nowrap">
                                {{ $page->created_at->format('M d, Y') }}
                            </x-ui.table.cell>
                            <x-ui.table.cell class="text-right whitespace-nowrap">
                                <x-ui.button size="sm" variant="secondary" wire:navigate href="{{ route('admin.pages.edit', $page->id) }}">
                                    Edit
                                </x-ui.button>
                                <x-ui.button size="sm" variant="danger" wire:click="deletePage({{ $page->id }})" wire:confirm="Are you sure you want to delete this page?">
                                    Delete
                                </x-ui.button>
                            </x-ui.table.cell>
                        </x-ui.table.row>
                    @empty
                        <x-ui.table.row>
                            <x-ui.table.cell colspan="5" class="text-center py-8 text-neural-500">
                                No pages found.
                            </x-ui.table.cell>
                        </x-ui.table.row>
                    @endforelse
                </x-slot:body>
            </x-ui.table>
        </div>

        @if($pages->hasPages())
            <div class="p-4 border-t border-neural-200 dark:border-neural-700">
                {{ $pages->links() }}
            </div>
        @endif
    </x-ui.card>
</div>
