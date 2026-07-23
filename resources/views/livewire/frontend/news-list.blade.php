<div>
    <!-- Hero Banner -->
    <div class="relative bg-slate-900 text-white overflow-hidden py-16">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900 to-indigo-900 opacity-90"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Latest News & Updates</h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto">Stay informed with the latest insights, announcements, and articles from the AI Society.</p>
        </div>
    </div>

    <!-- News Grid -->
    <div class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($newsItems as $news)
                    <article class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col h-full">
                        <a href="{{ route('news.show', $news->slug) }}" class="block relative aspect-w-16 aspect-h-9 overflow-hidden bg-slate-200">
                            @if($news->image_url)
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-48 flex items-center justify-center bg-indigo-50 text-indigo-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7.5M10 12h4m-4 4h4M6 8h.01" /></svg>
                                </div>
                            @endif
                        </a>
                        <div class="p-6 flex-grow flex flex-col">
                            <div class="flex items-center text-sm text-slate-500 mb-3 space-x-4">
                                @if($news->category)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ $news->category->name }}
                                    </span>
                                @endif
                                <time datetime="{{ $news->published_at->format('Y-m-d') }}">{{ $news->published_at->format('M d, Y') }}</time>
                            </div>
                            <a href="{{ route('news.show', $news->slug) }}" class="block mt-2">
                                <h3 class="text-xl font-bold text-slate-900 hover:text-indigo-600 transition-colors line-clamp-2">{{ $news->title }}</h3>
                                <p class="mt-3 text-base text-slate-500 line-clamp-3">{{ $news->excerpt }}</p>
                            </a>
                            <div class="mt-auto pt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="inline-block h-8 w-8 rounded-full overflow-hidden bg-slate-100">
                                        <svg class="h-full w-full text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-slate-900">{{ $news->user?->name ?? 'Admin' }}</p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $newsItems->links() }}
            </div>
        </div>
    </div>
</div>
