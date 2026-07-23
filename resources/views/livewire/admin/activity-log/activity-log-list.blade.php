<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Activity Log</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Track all system changes and user actions.
            </p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        
        <!-- Filters Area -->
        <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <div class="lg:col-span-2 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md leading-5 bg-white dark:bg-slate-700 placeholder-slate-500 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:text-white" placeholder="Search events...">
                </div>

                <div>
                    <select wire:model.live="causerFilter" class="block w-full pl-3 pr-10 py-2 text-base border-slate-300 dark:border-slate-600 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md bg-white dark:bg-slate-700 dark:text-white">
                        <option value="">All Users</option>
                        @foreach($causers as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select wire:model.live="subjectFilter" class="block w-full pl-3 pr-10 py-2 text-base border-slate-300 dark:border-slate-600 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md bg-white dark:bg-slate-700 dark:text-white">
                        <option value="">All Modules</option>
                        @foreach($subjects as $type => $name)
                            <option value="{{ $type }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <input wire:model.live="dateFrom" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md leading-5 bg-white dark:bg-slate-700 placeholder-slate-500 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:text-white" title="From Date">
                    </div>
                    <div class="w-1/2">
                        <input wire:model.live="dateTo" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md leading-5 bg-white dark:bg-slate-700 placeholder-slate-500 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:text-white" title="To Date">
                    </div>
                </div>

            </div>
            
            @if($search || $causerFilter || $subjectFilter || $dateFrom || $dateTo)
            <div class="mt-4 flex justify-end">
                <button wire:click="resetFilters" class="text-sm text-primary-600 hover:text-primary-500 font-medium">
                    Clear Filters
                </button>
            </div>
            @endif
        </div>

        <!-- Activity Timeline -->
        <div class="p-6">
            @if(count($activities) > 0)
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach($activities as $activity)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-slate-200 dark:bg-slate-700" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex items-start space-x-3">
                                    <div class="relative">
                                        @php
                                            $iconBg = match(strtolower($activity->event ?? '')) {
                                                'created' => 'bg-emerald-500',
                                                'updated' => 'bg-blue-500',
                                                'deleted' => 'bg-red-500',
                                                default => 'bg-slate-500'
                                            };
                                        @endphp
                                        <div class="h-10 w-10 rounded-full {{ $iconBg }} flex items-center justify-center ring-8 ring-white dark:ring-slate-800">
                                            @if(strtolower($activity->event ?? '') === 'created')
                                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            @elseif(strtolower($activity->event ?? '') === 'updated')
                                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            @elseif(strtolower($activity->event ?? '') === 'deleted')
                                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            @else
                                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1 py-0.5">
                                        <div class="text-sm">
                                            <span class="font-medium text-slate-900 dark:text-white">
                                                {{ $activity->causer ? $activity->causer->name : 'System' }}
                                            </span>
                                            <span class="text-slate-500 dark:text-slate-400">
                                                {{ $activity->description }}
                                            </span>
                                            @if($activity->subject_type)
                                                <span class="font-medium text-slate-900 dark:text-white">
                                                    {{ class_basename($activity->subject_type) }} 
                                                    @if($activity->subject_id) #{{ $activity->subject_id }} @endif
                                                </span>
                                            @endif
                                        </div>
                                        <div class="mt-1 flex items-center text-sm text-slate-500 dark:text-slate-400">
                                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $activity->created_at->format('M d, Y H:i:s') }}
                                            <span class="mx-2">&middot;</span>
                                            {{ $activity->created_at->diffForHumans() }}
                                        </div>
                                        
                                        @if($activity->properties && count($activity->properties) > 0)
                                            <div class="mt-2 text-sm text-slate-700 dark:text-slate-300">
                                                <div x-data="{ expanded: false }">
                                                    <button @click="expanded = !expanded" class="text-primary-600 hover:text-primary-500 text-xs font-medium focus:outline-none flex items-center">
                                                        <span x-text="expanded ? 'Hide Details' : 'View Details'"></span>
                                                        <svg class="ml-1 h-4 w-4 transform transition-transform duration-200" :class="{'rotate-180': expanded}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </button>
                                                    <div x-show="expanded" x-collapse class="mt-2 bg-slate-50 dark:bg-slate-900 rounded-md p-3 border border-slate-200 dark:border-slate-700 overflow-x-auto">
                                                        <pre class="text-xs text-slate-600 dark:text-slate-400 whitespace-pre-wrap font-mono">{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                @if($activities->hasPages())
                <div class="mt-8">
                    {{ $activities->links() }}
                </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No activities found</h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Try adjusting your filters or search query.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
