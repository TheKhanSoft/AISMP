<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Verify Email - AI Society')]
class EmailVerification extends Component
{
    public function resendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirect(route('member.dashboard', absolute: false), navigate: true);
            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        session()->flash('status', 'verification-link-sent');
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.email-verification');
    }
}
