<div class="min-h-screen flex items-center justify-center bg-slate-50 dark:bg-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-lg p-8 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-slate-900 dark:text-white">
                Verify your email
            </h2>
            <p class="mt-4 text-sm text-slate-600 dark:text-slate-400">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <button wire:click="resendVerification" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors disabled:opacity-50">
                <span wire:loading.remove wire:target="resendVerification">Resend Verification Email</span>
                <span wire:loading wire:target="resendVerification">Resending...</span>
            </button>

            <button wire:click="logout" type="button" class="underline text-sm text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Log Out
            </button>
        </div>
    </div>
</div>
