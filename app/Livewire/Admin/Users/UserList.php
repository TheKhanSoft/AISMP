<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Manage Users - AI Society')]
class UserList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = '';
    public string $statusFilter = '';
    public int $perPage = 15;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedRoleFilter(): void
    {
        $this->resetPage();
    }

    public function deleteUser(int $id): void
    {
        $user = User::findOrFail($id);
        
        if ($user->hasRole('super-admin') && User::role('super-admin')->count() <= 1) {
            $this->dispatch('notify', message: 'Cannot delete the last super admin.', type: 'error');
            return;
        }

        $user->delete();
        $this->dispatch('notify', message: 'User deleted successfully.', type: 'success');
    }

    public function toggleStatus(int $id): void
    {
        // Placeholder for user activation/deactivation logic since standard Laravel User model 
        // doesn't have `is_active` by default, but it's requested in the prompt.
        // Needs a migration to add this column in reality.
        
        try {
            $user = User::findOrFail($id);
            if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'is_active')) {
                $user->is_active = !$user->is_active;
                $user->save();
                $status = $user->is_active ? 'activated' : 'deactivated';
                $this->dispatch('notify', message: "User successfully {$status}.", type: 'success');
            } else {
                $this->dispatch('notify', message: "Status toggling not supported yet (missing DB column).", type: 'warning');
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Error updating user status.', type: 'error');
        }
    }

    public function exportUsers(): void
    {
        // Placeholder for export functionality
        $this->dispatch('notify', message: 'Export functionality will be implemented soon.', type: 'info');
    }

    public function render()
    {
        $query = User::query()->with('roles');

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->roleFilter)) {
            $query->role($this->roleFilter);
        }

        if ($this->statusFilter !== '') {
            if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'is_active')) {
                $query->where('is_active', $this->statusFilter === 'active');
            }
        }

        $users = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('livewire.admin.users.user-list', [
            'users' => $users,
        ]);
    }
}
