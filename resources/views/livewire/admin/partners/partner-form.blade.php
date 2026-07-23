<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-neural-900 dark:text-neural-100">{{ $recordId ? 'Edit' : 'Create' }} Partner</h1>
        <x-ui.button wire:navigate variant="secondary" href="{{ route('admin.partners.index') }}">Back</x-ui.button>
    </div>
    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 space-y-6">
                <x-ui.card>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300">Name</label>
                            <x-ui.input wire:model="name" class="w-full mt-1" />
                            @error('name') <span class="text-danger-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-neural-700 dark:text-neural-300">Logo</label>
                            <x-ui.input wire:model="logo" class="w-full mt-1" />
                            @error('logo') <span class="text-danger-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </x-ui.card>
            </div>
            <div class="space-y-6">
                <x-ui.card>
                    <div class="p-6 space-y-4">
                        <x-ui.button type="submit" class="w-full">
                            <span wire:loading.remove wire:target="save">Save Record</span>
                            <span wire:loading wire:target="save">Saving...</span>
                        </x-ui.button>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </form>
</div>
