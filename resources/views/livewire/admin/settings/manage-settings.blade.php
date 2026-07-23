<div>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Settings</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Manage system configurations and application preferences.
        </p>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Navigation -->
        <div class="w-full md:w-64 shrink-0">
            <nav class="flex md:flex-col gap-2 overflow-x-auto pb-4 md:pb-0" aria-label="Tabs">
                @foreach($groups as $key => $label)
                <button wire:click="changeGroup('{{ $key }}')" 
                        class="text-left px-4 py-2.5 rounded-lg text-sm font-medium transition-colors whitespace-nowrap {{ $group === $key ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                    {{ $label }}
                </button>
                @endforeach
            </nav>
        </div>

        <!-- Settings Form Area -->
        <div class="flex-1 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 md:p-8">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-700 pb-4">
                {{ $groups[$group] }}
            </h2>

            <form wire:submit="save" class="space-y-6">
                
                @if($group === 'general')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-full">
                        <label for="site_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Site Name</label>
                        <input wire:model="settings.site_name" type="text" id="site_name" required class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('settings.site_name') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-span-full">
                        <label for="site_tagline" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Site Tagline</label>
                        <input wire:model="settings.site_tagline" type="text" id="site_tagline" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>

                    <div class="col-span-full">
                        <label for="site_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Site Description</label>
                        <textarea wire:model="settings.site_description" id="site_description" rows="3" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                    </div>

                    <div>
                        <label for="timezone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Timezone</label>
                        <input wire:model="settings.timezone" type="text" id="timezone" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="e.g. UTC">
                    </div>

                    <div>
                        <label for="items_per_page" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Items Per Page</label>
                        <input wire:model="settings.items_per_page" type="number" id="items_per_page" required class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                </div>
                @endif

                @if($group === 'social')
                <div class="space-y-6">
                    @foreach(['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'github'] as $platform)
                    <div>
                        <label for="{{ $platform }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300 capitalize">{{ $platform }} URL</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-500 sm:text-sm">
                                https://
                            </span>
                            <input wire:model="settings.{{ $platform }}" type="text" id="{{ $platform }}" class="flex-1 block w-full min-w-0 rounded-none rounded-r-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @if($group === 'maintenance')
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input wire:model="settings.maintenance_mode" id="maintenance_mode" type="checkbox" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-slate-300 rounded dark:border-slate-600 dark:bg-slate-700">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="maintenance_mode" class="font-medium text-slate-700 dark:text-slate-300">Enable Maintenance Mode</label>
                            <p class="text-slate-500 dark:text-slate-400">When enabled, the site will be inaccessible to regular visitors.</p>
                        </div>
                    </div>

                    @if($settings['maintenance_mode'] ?? false)
                    <div>
                        <label for="maintenance_message" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Maintenance Message</label>
                        <textarea wire:model="settings.maintenance_message" id="maintenance_message" rows="4" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="We are currently performing scheduled maintenance..."></textarea>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Other groups would have their fields rendered similarly dynamically based on expected keys -->
                @if(!in_array($group, ['general', 'social', 'maintenance']))
                <div class="grid grid-cols-1 gap-6">
                    @foreach($this->getExpectedKeysForGroup($group) as $key)
                    <div>
                        <label for="{{ $key }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300 capitalize">{{ str_replace('_', ' ', $key) }}</label>
                        <input wire:model="settings.{{ $key }}" type="text" id="{{ $key }}" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="pt-6 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors disabled:opacity-50">
                        <span wire:loading.remove wire:target="save">Save Settings</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                </div>
                
                <!-- Notification area triggered by JS event listener -->
                <div x-data="{ show: false, message: '' }" 
                     x-on:notify.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
                     x-show="show" 
                     x-transition
                     class="fixed bottom-4 right-4 bg-emerald-500 text-white px-4 py-3 rounded-lg shadow-lg"
                     style="display: none;">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span x-text="message"></span>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
