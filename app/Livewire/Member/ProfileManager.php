<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileManager extends Component
{
    use WithFileUploads;

    public $name;
    public $phone;
    public $bio;
    public $designation;
    public $organization;
    public $website;
    public $social_links = [];
    public $avatar;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->phone = $user->phone ?? '';
        $this->bio = $user->bio ?? '';
        $this->designation = $user->designation ?? '';
        $this->organization = $user->organization ?? '';
        $this->website = $user->website ?? '';
        $this->social_links = $user->social_links ?? [];
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'designation' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'social_links' => 'nullable|array',
            'social_links.linkedin' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
            'social_links.github' => 'nullable|url',
            'avatar' => 'nullable|image|max:1024',
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'designation' => $this->designation,
            'organization' => $this->organization,
            'website' => $this->website,
            'social_links' => $this->social_links,
        ]);

        if ($this->avatar) {
            $user->addMedia($this->avatar->getRealPath())
                 ->usingName($this->avatar->getClientOriginalName())
                 ->toMediaCollection('avatar');
            $this->avatar = null;
        }

        session()->flash('profile_message', 'Profile updated successfully.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());
        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('password_message', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.member.profile-manager');
    }
}
