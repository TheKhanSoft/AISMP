<div>
    <!-- Include Swiper CSS and AOS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* Marquee Animation */
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-250px * 7)); } /* Adjust based on logo count/width */
        }
        .animate-scroll {
            animation: scroll 40s linear infinite;
        }
        .slider-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        }
        .mask-image-gradient {
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        .hover\:pause:hover {
            animation-play-state: paused;
        }
    </style>

    <!-- 1. Hero Section -->
    <section class="relative h-screen w-full overflow-hidden">
        <div class="swiper heroSwiper h-full w-full">
            <div class="swiper-wrapper">
                @foreach($heroSlides as $slide)
                <div class="swiper-slide relative">
                    <img src="{{ Storage::url($slide->image ?? 'default/hero.jpg') }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $slide->title }}">
                    <div class="absolute inset-0 slider-overlay"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                        <div class="max-w-4xl bg-white/10 backdrop-blur-lg border border-white/20 p-8 rounded-2xl shadow-2xl" data-aos="zoom-in" data-aos-duration="1000">
                            <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-4 drop-shadow-lg tracking-tight">{{ $slide->title }}</h1>
                            @if($slide->subtitle)
                                <p class="text-xl md:text-2xl text-gray-200 mb-8 font-light">{{ $slide->subtitle }}</p>
                            @endif
                            @if($slide->button_text)
                                <a href="{{ $slide->button_link ?? '#' }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg transform transition hover:scale-105">{{ $slide->button_text }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next text-white drop-shadow-md"></div>
            <div class="swiper-button-prev text-white drop-shadow-md"></div>
        </div>
    </section>

    <!-- 2. Featured Sections -->
    <section class="py-24 bg-slate-900 text-white overflow-hidden">
        <div class="container mx-auto px-6">
            @foreach($featuredSections as $index => $section)
            <div class="flex flex-col md:flex-row items-center gap-16 mb-24 {{ $index % 2 == 1 ? 'md:flex-row-reverse' : '' }}">
                <div class="w-full md:w-1/2" data-aos="{{ $index % 2 == 1 ? 'fade-left' : 'fade-right' }}" data-aos-duration="1000">
                    <div class="relative rounded-3xl overflow-hidden group shadow-2xl">
                        <div class="absolute inset-0 bg-blue-500/20 group-hover:bg-transparent transition duration-500 z-10"></div>
                        <img src="{{ Storage::url($section->image ?? 'default/featured.jpg') }}" alt="{{ $section->title }}" class="w-full h-auto object-cover transform group-hover:scale-110 transition duration-700">
                    </div>
                </div>
                <div class="w-full md:w-1/2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <h2 class="text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400">{{ $section->title }}</h2>
                    <div class="text-lg text-gray-300 leading-relaxed mb-8 prose prose-invert">
                        {!! $section->description !!}
                    </div>
                    @if($section->button_text)
                        <a href="{{ $section->button_link ?? '#' }}" class="text-indigo-400 hover:text-indigo-300 font-semibold flex items-center gap-2 group">
                            {{ $section->button_text }}
                            <svg class="w-5 h-5 transform group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- 3. Statistics -->
    <section class="py-20 relative bg-gradient-to-br from-indigo-900 to-blue-900">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($statistics as $stat)
                <div class="text-center bg-white/5 backdrop-blur-md rounded-2xl p-8 border border-white/10 shadow-xl" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Icon placeholder -->
                    <div class="text-blue-400 mb-4 flex justify-center">
                        <i class="{{ $stat->icon ?? 'fas fa-chart-line' }} text-4xl"></i>
                    </div>
                    <div class="text-5xl font-extrabold text-white mb-2" x-data="{ count: 0 }" x-init="
                        let target = {{ $stat->value ?? 0 }};
                        let time = 2000;
                        let steps = 50;
                        let stepTime = Math.abs(Math.floor(time / steps));
                        let current = 0;
                        let increment = target / steps;
                        let timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                count = target;
                                clearInterval(timer);
                            } else {
                                count = Math.round(current);
                            }
                        }, stepTime);
                    " x-text="count">0</div>
                    <div class="text-lg text-blue-200 font-medium tracking-wide uppercase">{{ $stat->label }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. Latest News -->
    <section class="py-24 bg-slate-950">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Latest <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">News</span></h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Stay updated with our latest insights, announcements, and AI breakthroughs.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($news as $article)
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden hover:transform hover:-translate-y-2 transition duration-300 shadow-lg group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <div class="h-60 overflow-hidden relative">
                        <img src="{{ Storage::url($article->image ?? 'default/news.jpg') }}" alt="{{ $article->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                            {{ $article->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-blue-400 transition line-clamp-2">
                            <a href="#">{{ $article->title }}</a>
                        </h3>
                        <p class="text-gray-400 mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>
                        <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 font-medium">
                            Read More <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. Testimonials -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <!-- Decorative blur blobs -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-blue-600/30 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-purple-600/30 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">What People <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Say</span></h2>
            </div>
            
            <div class="swiper testimonialSwiper pb-12">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                    <div class="swiper-slide h-auto">
                        <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-10 rounded-3xl mx-4 my-2 shadow-2xl flex flex-col items-center text-center h-full">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-blue-500/30 mb-6 shadow-lg">
                                <img src="{{ Storage::url($testimonial->image ?? 'default/avatar.png') }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                            </div>
                            <svg class="w-10 h-10 text-blue-400/50 mb-4 flex-shrink-0" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                                <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                            </svg>
                            <p class="text-gray-300 italic mb-8 text-lg flex-grow">"{{ $testimonial->content }}"</p>
                            <div>
                                <h4 class="font-bold text-white text-xl">{{ $testimonial->name }}</h4>
                                <p class="text-blue-400 text-sm font-medium">{{ $testimonial->designation }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- 6. Partners -->
    <section class="py-16 bg-slate-950 border-t border-white/5 overflow-hidden">
        <div class="container mx-auto px-6 mb-8 text-center" data-aos="fade-up">
            <h4 class="text-gray-400 font-semibold tracking-widest uppercase">Trusted By Industry Leaders</h4>
        </div>
        <div class="relative w-full flex overflow-hidden mask-image-gradient">
            <div class="flex animate-scroll whitespace-nowrap items-center hover:pause">
                @foreach($partners as $partner)
                <div class="flex-none mx-8 w-48 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition duration-300">
                    <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain filter drop-shadow-md brightness-200 hover:brightness-100 transition-all">
                </div>
                @endforeach
                <!-- Duplicate for seamless scroll -->
                @foreach($partners as $partner)
                <div class="flex-none mx-8 w-48 h-24 flex items-center justify-center grayscale hover:grayscale-0 transition duration-300">
                    <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain filter drop-shadow-md brightness-200 hover:brightness-100 transition-all">
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        document.addEventListener('livewire:navigated', () => {
            initScripts();
        });
        
        document.addEventListener('DOMContentLoaded', () => {
            initScripts();
        });

        function initScripts() {
            // Init AOS
            AOS.init({
                once: true,
                offset: 50,
            });

            // Init Hero Swiper
            new Swiper(".heroSwiper", {
                loop: true,
                effect: "fade",
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".heroSwiper .swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".heroSwiper .swiper-button-next",
                    prevEl: ".heroSwiper .swiper-button-prev",
                },
            });

            // Init Testimonial Swiper
            new Swiper(".testimonialSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".testimonialSwiper .swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        }
    </script>
</div>
