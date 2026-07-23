<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Welcome back, {{ auth()->user()->full_name }}!</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Here's what's happening with your membership today.</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <x-ui.stat-card 
            title="Membership Status"
            value="{{ $activeMembership ? 'Active' : 'Inactive' }}"
            icon="heroicon-o-check-badge"
            color="{{ $activeMembership ? 'green' : 'red' }}"
        />
        <x-ui.stat-card 
            title="Upcoming Events"
            value="{{ $upcomingEventsCount }}"
            icon="heroicon-o-calendar"
            color="blue"
        />
        <x-ui.stat-card 
            title="Active Courses"
            value="{{ $activeCoursesCount }}"
            icon="heroicon-o-academic-cap"
            color="indigo"
        />
    </div>

    <!-- Upcoming Events Glass Card -->
    <x-ui.card class="glass-card mb-8">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Your Upcoming Events</h2>
            
            @if($events->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 dark:bg-gray-700/50 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Event Name</th>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $registration)
                                <tr class="bg-white/50 border-b dark:bg-gray-800/50 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $registration->event?->title ?? 'Unknown Event' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $registration->event?->start_date?->format('M d, Y') ?? 'TBA' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ $registration->status->name ?? 'Registered' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 dark:text-gray-400">You are not registered for any upcoming events.</p>
                    <a href="{{ route('member.events.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        Browse Events &rarr;
                    </a>
                </div>
            @endif
        </div>
    </x-ui.card>
</div>
