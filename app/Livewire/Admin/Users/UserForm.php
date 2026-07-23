<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('User Form - AI Society')]
class UserForm extends Component
{
    use WithFileUploads;

    public ?int $userId = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'member';
    public bool $is_active = true;
    public string $phone = '';
    public string $bio = '';
    public string $designation = '';
    public string $organization = '';
    
    public $avatar;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $user = User::findOrFail($id);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->roles->first()?->name ?? 'member';
            
            if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'is_active')) {
                $this->is_active = (bool) $user->is_active;
            }
            if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'phone')) {
                $this->phone = $user->phone ?? '';
                $this->bio = $user->bio ?? '';
                $this->designation = $user->designation ?? '';
                $this->organization = $user->organization ?? '';
            }
        }
    }

    protected function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->userId],
            'role' => ['required', 'string'],
            'is_active' => ['boolean'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'designation' => ['nullable', 'string', 'max:100'],
            'organization' => ['nullable', 'string', 'max:100'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ];

        if (!$this->userId || !empty($this->password)) {
            $rules['password'] = ['required', 'string', 'min:8'];
        }

        return $rules;
    }

    public function save(): void
    {
        $validatedData = $this->validate();

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if (!empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'is_active')) {
            $userData['is_active'] = $this->is_active;
            $userData['phone'] = $this->phone;
            $userData['bio'] = $this->bio;
            $userData['designation'] = $this->designation;
            $userData['organization'] = $this->organization;
        }

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update($userData);
            $message = 'User updated successfully.';
        } else {
            $user = User::create($userData);
            $message = 'User created successfully.';
        }

        // Handle Avatar using Spatie Media Library
        if ($this->avatar) {
            $user->addMedia($this->avatar->getRealPath())
                 ->toMediaCollection('avatar');
        }

        // Assign role
        $user->syncRoles([$this->role]);

        session()->flash('notify', ['message' => $message, 'type' => 'success']);
        
        $this->redirect(route('admin.users'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.users.user-form');
    }
}
