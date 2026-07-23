<div>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                {{ $userId ? 'Edit User' : 'Create User' }}
            </h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                {{ $userId ? 'Update user details and permissions.' : 'Add a new user to the system.' }}
            </p>
        </div>
        <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">
            Cancel
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
        <form wire:submit="save" class="divide-y divide-slate-200 dark:divide-slate-700">
            
            <!-- Basic Information -->
            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Basic Information</h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Profile details and contact information.
                    </p>
                </div>
                <div class="md:col-span-2 space-y-6">
                    
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0 h-20 w-20 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center overflow-hidden border border-slate-200 dark:border-slate-600">
                            @if ($avatar)
                                <img src="{{ $avatar->temporaryUrl() }}" class="h-full w-full object-cover">
                            @else
                                <svg class="h-10 w-10 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <label for="avatar" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Avatar</label>
                            <input wire:model="avatar" type="file" id="avatar" accept="image/*" class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-slate-700 dark:file:text-slate-300">
                            @error('avatar') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Full Name</label>
                            <input wire:model="name" type="text" id="name" required class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @error('name') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email Address</label>
                            <input wire:model="email" type="email" id="email" required class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @error('email') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Phone Number</label>
                            <input wire:model="phone" type="text" id="phone" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @error('phone') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Professional Details</h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Organization and designation information.
                    </p>
                </div>
                <div class="md:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="designation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Designation</label>
                            <input wire:model="designation" type="text" id="designation" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @error('designation') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="organization" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Organization</label>
                            <input wire:model="organization" type="text" id="organization" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @error('organization') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Bio / About</label>
                        <textarea wire:model="bio" id="bio" rows="4" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                        @error('bio') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Access & Security -->
            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Security & Access</h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Manage roles, status, and password.
                    </p>
                </div>
                <div class="md:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Role</label>
                            <select wire:model="role" id="role" required class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="member">Member</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                                @if(auth()->user()->hasRole('super-admin'))
                                <option value="super-admin">Super Admin</option>
                                @endif
                            </select>
                            @error('role') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Password
                                @if($userId) <span class="text-slate-400 font-normal">(Leave blank to keep current)</span> @endif
                            </label>
                            <input wire:model="password" type="password" id="password" {{ !$userId ? 'required' : '' }} class="mt-1 block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @error('password') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input wire:model="is_active" id="is_active" type="checkbox" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-slate-300 rounded dark:border-slate-600 dark:bg-slate-700">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-slate-700 dark:text-slate-300">Active Account</label>
                            <p class="text-slate-500 dark:text-slate-400">Uncheck to temporarily disable access for this user.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="p-6 md:p-8 bg-slate-50 dark:bg-slate-800/50 flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors disabled:opacity-50">
                    <span wire:loading.remove wire:target="save">
                        {{ $userId ? 'Update User' : 'Create User' }}
                    </span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>

        </form>
    </div>
</div>
