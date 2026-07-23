<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="$store.darkMode.on ? 'dark' : ''">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AI Society') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 dark:text-slate-200 dark:bg-slate-900 transition-colors duration-300 flex flex-col min-h-screen">
    
    <!-- Navigation Bar -->
    <nav x-data="{ mobileMenuOpen: false }" class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center text-2xl font-bold text-primary-600 dark:text-primary-400">
                        <span class="gradient-text">AI Society</span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-primary-500 text-sm font-medium text-slate-900 dark:text-white">Home</a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300">About</a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300">Events</a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300">Blog</a>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-4">
                    <button @click="$store.darkMode.toggle()" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                        <svg x-show="$store.darkMode.on" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg x-show="!$store.darkMode.on" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400">Dashboard</a>
                    @else
                        <a href="{{ route('login') ?? '#' }}" class="text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400">Log in</a>
                        <a href="{{ route('register') ?? '#' }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">Register</a>
                    @endauth
                </div>
                
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none">
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">
            <div class="pt-2 pb-3 space-y-1">
                <a href="#" class="block pl-3 pr-4 py-2 border-l-4 border-primary-500 text-base font-medium text-primary-700 bg-primary-50 dark:text-primary-400 dark:bg-slate-800">Home</a>
                <a href="#" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white dark:hover:bg-slate-800">About</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(isset($hero))
            {{ $hero }}
        @endif
        
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-1">
                    <span class="text-xl font-bold gradient-text">AI Society</span>
                    <p class="mt-4 text-slate-500 dark:text-slate-400 text-sm">Empowering the next generation of innovators through AI research, education, and collaboration.</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Quick Links</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-base text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400">About Us</a></li>
                        <li><a href="#" class="text-base text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400">Events</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Legal</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-base text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400">Privacy Policy</a></li>
                        <li><a href="#" class="text-base text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Subscribe</h3>
                    <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">Get the latest news and updates.</p>
                    <form class="mt-4 flex">
                        <input type="email" placeholder="Enter your email" class="flex-1 min-w-0 px-4 py-2 text-base text-slate-900 placeholder-slate-500 bg-white border border-slate-300 rounded-l-md focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-slate-800 dark:border-slate-700 dark:text-white">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="mt-12 border-t border-slate-200 dark:border-slate-800 pt-8 flex items-center justify-between">
                <p class="text-base text-slate-400 xl:text-center">&copy; {{ date('Y') }} AI Society. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <button x-data="{ show: false }" @scroll.window="show = window.pageYOffset > 500" @click="window.scrollTo({top: 0, behavior: 'smooth'})" x-show="show" x-transition class="fixed bottom-8 right-8 p-3 rounded-full bg-primary-600 text-white shadow-lg hover:bg-primary-700 focus:outline-none z-50" style="display: none;">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>
    
    @livewireScripts
</body>
</html>
