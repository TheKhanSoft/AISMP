<div class="min-h-screen flex items-center justify-center bg-slate-50 dark:bg-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-lg p-8 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-slate-900 dark:text-white">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center text-sm text-slate-600 dark:text-slate-400">
                Or
                <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">
                    create a new membership
                </a>
            </p>
        </div>
        
        <form wire:submit="authenticate" class="mt-8 space-y-6">
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email address</label>
                    <input wire:model="email" id="email" type="email" autocomplete="email" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                    @error('email') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                    <input wire:model="password" id="password" type="password" autocomplete="current-password" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                    @error('password') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input wire:model="remember" id="remember" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-slate-300 rounded dark:border-slate-600 dark:bg-slate-700">
                    <label for="remember" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-primary-500 group-hover:text-primary-400 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span wire:loading.remove wire:target="authenticate">Sign in</span>
                    <span wire:loading wire:target="authenticate">Signing in...</span>
                </button>
            </div>
            
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-300 dark:border-slate-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-slate-800 text-slate-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm bg-white dark:bg-slate-700 text-sm font-medium text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                            <span class="sr-only">Sign in with Google</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
                            </svg>
                        </a>
                    </div>

                    <div>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm bg-white dark:bg-slate-700 text-sm font-medium text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                            <span class="sr-only">Sign in with LinkedIn</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
