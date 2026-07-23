<div>
    <!-- Hero Banner -->
    <div class="relative bg-blue-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-indigo-800 opacity-90"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4">{{ $page->title ?? 'About AI Society' }}</h1>
            <p class="text-xl md:text-2xl max-w-3xl text-blue-100">Our mission is to advance artificial intelligence for the benefit of humanity.</p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-lg prose-blue max-w-none">
            {!! $page->content ?? '' !!}
        </div>
    </div>

    <!-- Council Members Grid -->
    <div class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-900">Our Leadership Council</h2>
                <p class="mt-4 text-lg text-slate-600">Meet the experts guiding the future of AI Society.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($councilMembers as $member)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow duration-300 group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-slate-200 relative">
                            @if($member->image_url)
                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-64 flex items-center justify-center bg-indigo-50 text-indigo-300">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $member->name }}</h3>
                            <p class="text-indigo-600 font-medium text-sm mb-4">{{ $member->role }}</p>
                            
                            <div class="flex justify-center space-x-4">
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="text-slate-400 hover:text-indigo-600 transition-colors">
                                        <span class="sr-only">LinkedIn</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    </a>
                                @endif
                                @if($member->twitter_url)
                                    <a href="{{ $member->twitter_url }}" target="_blank" class="text-slate-400 hover:text-sky-500 transition-colors">
                                        <span class="sr-only">Twitter</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
