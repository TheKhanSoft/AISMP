<div>
    <div class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to News
                </a>
            </div>

            <div class="text-center mb-12">
                @if($news->category)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 mb-4">
                        {{ $news->category->name }}
                    </span>
                @endif
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">{{ $news->title }}</h1>
                <div class="flex items-center justify-center space-x-4 text-slate-500">
                    <div class="flex items-center">
                        <svg class="mr-1.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span>{{ $news->user?->name ?? 'Admin' }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="mr-1.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <time datetime="{{ $news->published_at->format('Y-m-d') }}">{{ $news->published_at->format('F d, Y') }}</time>
                    </div>
                    <div class="flex items-center">
                        <svg class="mr-1.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <span>{{ $news->views_count }} views</span>
                    </div>
                </div>
            </div>

            @if($news->image_url)
                <div class="mb-12 rounded-2xl overflow-hidden shadow-lg border border-slate-100">
                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-auto object-cover">
                </div>
            @endif

            <div class="prose prose-lg prose-indigo max-w-none prose-img:rounded-xl">
                {!! $news->content !!}
            </div>
        </div>
    </div>
</div>
