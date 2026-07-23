<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-neural-900 dark:text-neural-100">Manage Categories</h1>
        <x-ui.button wire:navigate href="{{ route('admin.categories.create') }}">Create New</x-ui.button>
    </div>
    <x-ui.card>
        <div class="p-4 flex items-center justify-between border-b border-neural-200 dark:border-neural-700">
            <x-ui.input wire:model.live="search" placeholder="Search..." type="search" class="w-64" />
        </div>
        <x-ui.table>
            <x-slot:head>
                <x-ui.table.row>
                    <x-ui.table.heading>Name</x-ui.table.heading>
                    <x-ui.table.heading>Type</x-ui.table.heading>
                    <x-ui.table.heading class="text-right">Actions</x-ui.table.heading>
                </x-ui.table.row>
            </x-slot:head>
            <x-slot:body>
                @forelse($records as $record)
                <x-ui.table.row>
                    <x-ui.table.cell>{{ $record->name ?? 'N/A' }}</x-ui.table.cell>
                    <x-ui.table.cell>{{ $record->type ?? 'N/A' }}</x-ui.table.cell>
                    <x-ui.table.cell class="text-right">
                        <x-ui.button size="sm" variant="secondary" wire:navigate href="{{ route('admin.categories.edit', $record) }}">Edit</x-ui.button>
                        <x-ui.button size="sm" variant="danger" wire:click="delete({{ $record->id }})" wire:confirm="Are you sure?">Delete</x-ui.button>
                    </x-ui.table.cell>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.cell colspan="10" class="text-center text-neural-500">No records found.</x-ui.table.cell>
                </x-ui.table.row>
                @endforelse
            </x-slot:body>
        </x-ui.table>
        <div class="p-4 border-t border-neural-200 dark:border-neural-700">
            {{ $records->links() }}
        </div>
    </x-ui.card>
</div>
