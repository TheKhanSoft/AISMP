@props(['items' => []])

<nav class="flex" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-2 sm:space-x-4">
        <li>
            <div>
                <a href="/" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300 transition-colors">
                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Home</span>
                </a>
            </div>
        </li>
        
        @foreach($items as $item)
            <li>
                <div class="flex items-center">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300 dark:text-slate-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    @if(isset($item['url']) && !$loop->last)
                        <a href="{{ $item['url'] }}" class="ml-2 sm:ml-4 text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="ml-2 sm:ml-4 text-sm font-medium text-slate-700 dark:text-slate-200" aria-current="page">
                            {{ $item['label'] }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
