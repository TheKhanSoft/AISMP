<div>
    <!-- Hero Banner -->
    <div class="bg-slate-900 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">Frequently Asked Questions</h1>
            <p class="text-xl text-slate-300">Find answers to common questions about the AI Society, memberships, and our initiatives.</p>
        </div>
    </div>

    <!-- FAQs Accordion -->
    <div class="py-16 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4" x-data="{ active: null }">
                @foreach($faqs as $index => $faq)
                    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                        <button 
                            @click="active !== {{ $index }} ? active = {{ $index }} : active = null"
                            class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none"
                        >
                            <span class="text-lg font-medium text-slate-900 pr-4">{{ $faq->question }}</span>
                            <span class="flex-shrink-0 text-indigo-500 transform transition-transform duration-300" :class="{ 'rotate-180': active === {{ $index }} }">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div 
                            x-show="active === {{ $index }}" 
                            x-collapse 
                            x-cloak
                        >
                            <div class="px-6 pb-5 pt-1 text-slate-600 prose prose-indigo max-w-none">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($faqs->isEmpty())
                <div class="text-center py-12 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <h3 class="mt-2 text-sm font-medium text-slate-900">No FAQs</h3>
                    <p class="mt-1 text-sm text-slate-500">We are currently updating our frequently asked questions.</p>
                </div>
            @endif
        </div>
    </div>
</div>
