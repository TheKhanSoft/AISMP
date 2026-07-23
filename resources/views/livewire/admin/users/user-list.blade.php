<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Users</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Manage members, admins, and system users.
            </p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <button wire:click="exportUsers" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">
                <svg class="-ml-1 mr-2 h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                Export
            </button>
            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add User
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <!-- Filters -->
        <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md leading-5 bg-white dark:bg-slate-700 placeholder-slate-500 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:text-white" placeholder="Search users...">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <select wire:model.live="roleFilter" class="block w-full pl-3 pr-10 py-2 text-base border-slate-300 dark:border-slate-600 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md bg-white dark:bg-slate-700 dark:text-white">
                    <option value="">All Roles</option>
                    <option value="super-admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="member">Member</option>
                </select>
                
                <select wire:model.live="statusFilter" class="block w-full pl-3 pr-10 py-2 text-base border-slate-300 dark:border-slate-600 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md bg-white dark:bg-slate-700 dark:text-white">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Joined</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center font-bold text-lg">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-slate-900 dark:text-white">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-wrap gap-1">
                                @forelse($user->roles as $role)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @empty
                                    <span class="text-sm text-slate-500">None</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(isset($user->is_active))
                                @if($user->is_active)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    Active
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                    Inactive
                                </span>
                                @endif
                            @else
                                <span class="text-sm text-slate-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="toggleStatus({{ $user->id }})" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 mr-3" title="Toggle Status">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                            </button>
                            <a href="#" class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 mr-3">Edit</a>
                            <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">
                            <div class="flex flex-col items-center">
                                <svg class="h-12 w-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="text-lg font-medium">No users found</p>
                                <p class="text-sm">Try adjusting your search or filters.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
            {{ $users->links() }}
        </div>
        @endif
    </div>

    <!-- Notification -->
    <div x-data="{ show: false, message: '', type: 'success' }" 
         x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
         x-show="show" 
         x-transition
         class="fixed bottom-4 right-4 px-4 py-3 rounded-lg shadow-lg text-white"
         :class="{
            'bg-emerald-500': type === 'success',
            'bg-red-500': type === 'error',
            'bg-amber-500': type === 'warning',
            'bg-blue-500': type === 'info'
         }"
         style="display: none;">
        <div class="flex items-center space-x-2">
            <span x-text="message"></span>
        </div>
    </div>
</div>
