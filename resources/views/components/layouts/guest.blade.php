<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="$store.darkMode.on ? 'dark' : ''">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AI Society') }} - Authentication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 dark:text-slate-200 dark:bg-slate-900 transition-colors duration-300">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 neural-bg relative overflow-hidden">
        
        <!-- Theme Toggle -->
        <div class="absolute top-4 right-4">
            <button @click="$store.darkMode.toggle()" class="p-2 rounded-full glass hover:bg-white/20 dark:hover:bg-slate-800/50 text-slate-600 dark:text-slate-300 transition-all">
                <svg x-show="$store.darkMode.on" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <svg x-show="!$store.darkMode.on" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>

        <div>
            <a href="/" class="text-3xl font-bold gradient-text tracking-tight">
                AI Society
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 glass-card overflow-hidden" data-aos="fade-up">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
</body>
</html>
