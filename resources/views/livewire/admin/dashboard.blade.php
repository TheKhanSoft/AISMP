<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                Welcome back, {{ auth()->user()->name }}!
            </h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Here's what's happening with the AI Society today. {{ now()->format('l, F j, Y') }}
            </p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add News
            </a>
            <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-accent-600 hover:bg-accent-700">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                New Event
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Members -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Members</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($totalMembers) }}</p>
            </div>
        </div>

        <!-- Pending Memberships -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex items-center">
            <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Pending Members</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($pendingMemberships) }}</p>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex items-center">
            <div class="p-3 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Upcoming Events</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($upcomingEvents) }}</p>
            </div>
        </div>

        <!-- Contact Messages -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex items-center">
            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Unread Messages</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($contactMessages) }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Tables & Lists (Takes up 2 cols on large screens) -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Charts Placeholder -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Membership Growth</h3>
                <div class="h-72 flex items-center justify-center bg-slate-50 dark:bg-slate-900 rounded-lg border border-dashed border-slate-300 dark:border-slate-700">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                        <p class="mt-2 text-sm text-slate-500">ApexCharts will be initialized here via Alpine.js</p>
                    </div>
                </div>
            </div>

            <!-- Recent Members -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Members</h3>
                    <a href="{{ route('admin.users') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700">
                            @forelse($recentMembers as $member)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold">
                                            {{ substr($member['name'], 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $member['name'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                    {{ $member['email'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                    {{ \Carbon\Carbon::parse($member['created_at'])->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-slate-500">No members found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Activity Feed -->
        <div class="space-y-8">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Activity</h3>
                    <a href="{{ route('admin.activity-log') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                </div>
                
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @forelse($recentActivityList as $index => $log)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-slate-200 dark:bg-slate-700" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center ring-8 ring-white dark:ring-slate-800">
                                            <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                                {{ (array)$log['description'] ?? 'Activity recorded' }}
                                            </p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-slate-500">
                                            {{ \Carbon\Carbon::parse((array)$log['created_at'])->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="py-4 text-center text-sm text-slate-500">
                            No recent activity found.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
