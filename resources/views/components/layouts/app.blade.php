<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'AI Society') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 dark:text-slate-200 dark:bg-slate-950 flex flex-col min-h-screen selection:bg-primary-500 selection:text-white" x-data="{ mobileMenuOpen: false }">
    
    <!-- Navigation Bar -->
    <nav class="fixed w-full bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-b border-white/20 dark:border-slate-800/50 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo Left -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-600 to-primary-400 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary-500/30 group-hover:shadow-primary-500/50 transition-all">
                            AI
                        </div>
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-600 dark:from-white dark:to-slate-300">Society</span>
                    </a>
                </div>
                
                <!-- Links Center -->
                <div class="hidden md:flex flex-1 justify-center items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400 transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400 transition-colors">About</a>
                    <a href="{{ route('news') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400 transition-colors">News</a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400 transition-colors">Contact</a>
                    <a href="{{ route('faqs') }}" class="text-sm font-medium text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400 transition-colors">FAQs</a>
                </div>
                
                <!-- Buttons Right -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/member') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100 transition-all hover:scale-105 active:scale-95">Member Portal</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all hover:scale-105 active:scale-95">Join Now</a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none transition-colors">
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden absolute w-full bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 shadow-xl" style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-primary-400 dark:hover:bg-slate-800">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-primary-400 dark:hover:bg-slate-800">About</a>
                <a href="{{ route('news') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-primary-400 dark:hover:bg-slate-800">News</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-primary-400 dark:hover:bg-slate-800">Contact</a>
                <a href="{{ route('faqs') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-primary-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-primary-400 dark:hover:bg-slate-800">FAQs</a>
                
                <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-800 flex flex-col gap-3">
                    @auth
                        <a href="{{ url('/member') }}" class="w-full text-center px-5 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-slate-900 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100">Member Portal</a>
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center px-5 py-3 border border-slate-300 dark:border-slate-700 rounded-xl shadow-sm text-base font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">Login</a>
                        <a href="{{ route('register') }}" class="w-full text-center px-5 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700">Join Now</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-900 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                <div class="md:col-span-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group mb-6">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-600 to-primary-400 flex items-center justify-center text-white font-bold text-sm shadow-md">
                            AI
                        </div>
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-600 dark:from-white dark:to-slate-300">Society</span>
                    </a>
                    <p class="mt-4 text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                        Empowering the next generation of innovators through AI research, education, and collaboration. Join the community shaping the future of artificial intelligence.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-slate-400 hover:text-primary-500 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-primary-500 transition-colors">
                            <span class="sr-only">GitHub</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-primary-500 transition-colors">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"/></svg>
                        </a>
                    </div>
                </div>
                <div class="md:col-span-2 md:col-start-6">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Explore</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">About</a></li>
                        <li><a href="{{ route('news') }}" class="text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">News</a></li>
                    </ul>
                </div>
                <div class="md:col-span-2">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Support</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('faqs') }}" class="text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">FAQs</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Contact</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="md:col-span-3">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Newsletter</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Stay updated with the latest AI trends.</p>
                    <form class="flex flex-col sm:flex-row gap-2">
                        <input type="email" placeholder="Email address" class="w-full px-4 py-2.5 text-sm text-slate-900 placeholder-slate-500 bg-slate-100 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white dark:bg-slate-900 dark:border-slate-800 dark:text-white dark:focus:bg-slate-900 transition-all">
                        <button type="submit" class="whitespace-nowrap px-4 py-2.5 rounded-lg text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="mt-16 border-t border-slate-200 dark:border-slate-800/50 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-500 dark:text-slate-400">&copy; {{ date('Y') }} AI Society. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-sm text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Terms</a>
                    <a href="#" class="text-sm text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="text-sm text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- AOS and Swiper Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                once: true,
                offset: 50,
                duration: 800,
                easing: 'ease-out-cubic',
            });
        });
    </script>
    
    @livewireScripts
</body>
</html>
