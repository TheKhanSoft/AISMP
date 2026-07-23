<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="$store.darkMode.on ? 'dark' : ''">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AI Society') }} - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 dark:text-slate-200 dark:bg-slate-900 transition-colors duration-300">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 transition-transform duration-300 lg:static lg:translate-x-0 lg:inset-auto overflow-y-auto flex flex-col">
            <div class="flex items-center justify-center h-16 border-b border-slate-200 dark:border-slate-700 shrink-0">
                <a href="#" class="text-xl font-bold text-primary-600 dark:text-primary-400">AI Society Admin</a>
            </div>
            
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="#" class="flex items-center px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg group">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg group">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                            Content
                        </div>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-11 pr-4 py-1 space-y-1">
                        <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">Pages</a>
                        <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">Hero Slides</a>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg group">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Users & Roles
                        </div>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-11 pr-4 py-1 space-y-1">
                        <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">All Users</a>
                        <a href="#" class="block px-2 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">Roles</a>
                    </div>
                </div>

                <a href="#" class="flex items-center px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg group">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between h-16 px-6 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 shrink-0">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-slate-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="hidden md:flex relative ml-4">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" class="w-full py-2 pl-10 pr-4 text-sm text-slate-700 bg-slate-100 border-none rounded-lg dark:bg-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-primary-500" placeholder="Search...">
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button @click="$store.darkMode.toggle()" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                        <svg x-show="$store.darkMode.on" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg x-show="!$store.darkMode.on" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>
                    
                    <button class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-danger-500 rounded-full"></span>
                    </button>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center focus:outline-none">
                            <img class="w-8 h-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="User">
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 w-48 mt-2 py-2 bg-white dark:bg-slate-800 rounded-lg shadow-xl border border-slate-200 dark:border-slate-700 z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">Settings</a>
                            <div class="border-t border-slate-200 dark:border-slate-700 my-1"></div>
                            <form method="POST" action="#">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-danger-600 dark:text-danger-400 hover:bg-slate-100 dark:hover:bg-slate-700">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-slate-900 p-6">
                @if(isset($header))
                    <div class="mb-6">
                        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $header }}</h1>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>
