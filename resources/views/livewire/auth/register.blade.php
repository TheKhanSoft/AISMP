<div class="min-h-screen flex items-center justify-center bg-slate-50 dark:bg-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-lg p-8 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-slate-900 dark:text-white">
                Create an account
            </h2>
            <p class="mt-2 text-center text-sm text-slate-600 dark:text-slate-400">
                Already a member?
                <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">
                    Sign in here
                </a>
            </p>
        </div>
        
        <form wire:submit="register" class="mt-8 space-y-6">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Full Name</label>
                    <input wire:model="name" id="name" type="text" autocomplete="name" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                    @error('name') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email address</label>
                    <input wire:model="email" id="email" type="email" autocomplete="email" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                    @error('email') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                    <input wire:model="password" id="password" type="password" autocomplete="new-password" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                    @error('password') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Confirm Password</label>
                    <input wire:model="password_confirmation" id="password_confirmation" type="password" autocomplete="new-password" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                </div>
            </div>

            <div class="flex items-center">
                <input wire:model="terms" id="terms" type="checkbox" required class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-slate-300 rounded dark:border-slate-600 dark:bg-slate-700">
                <label for="terms" class="ml-2 block text-sm text-slate-900 dark:text-slate-300">
                    I agree to the <a href="#" class="text-primary-600 hover:text-primary-500 dark:text-primary-400">Terms of Service</a> and <a href="#" class="text-primary-600 hover:text-primary-500 dark:text-primary-400">Privacy Policy</a>
                </label>
            </div>
            @error('terms') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="register">Create Account</span>
                    <span wire:loading wire:target="register">Creating...</span>
                </button>
            </div>
        </form>
    </div>
</div>
