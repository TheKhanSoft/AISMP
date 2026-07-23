<div class="min-h-screen flex items-center justify-center bg-slate-50 dark:bg-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-lg p-8 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-slate-900 dark:text-white">
                Create new password
            </h2>
        </div>
        
        <form wire:submit="resetPassword" class="mt-8 space-y-6">
            <input type="hidden" wire:model="token">
            
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email address</label>
                    <input wire:model="email" id="email" type="email" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                    @error('email') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">New Password</label>
                    <input wire:model="password" id="password" type="password" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                    @error('password') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Confirm New Password</label>
                    <input wire:model="password_confirmation" id="password_confirmation" type="password" required class="mt-1 appearance-none relative block w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 placeholder-slate-500 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors disabled:opacity-50">
                    <span wire:loading.remove wire:target="resetPassword">Reset Password</span>
                    <span wire:loading wire:target="resetPassword">Resetting...</span>
                </button>
            </div>
        </form>
    </div>
</div>
