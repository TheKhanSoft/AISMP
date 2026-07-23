<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Partners;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Partner;

#[Layout('components.layouts.admin')]
#[Title('Manage Partners')]
class PartnerList extends Component
{
    use WithPagination;

    public string $search = '';
    public array $selected = [];

    public function delete(int $id): void
    {
        $this->authorize('delete', Partner::class);
        $record = Partner::findOrFail($id);
        $record->delete();
        activity()->performedOn($record)->log('deleted');
        $this->dispatch('notify', type: 'success', message: 'Record deleted successfully.');
    }

    public function render()
    {
        $this->authorize('viewAny', Partner::class);
        $records = Partner::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%')->orWhere('name', 'like', '%' . $this->search . '%'))
            ->paginate(15);

        return view('livewire.admin/partners.partner-list', compact('records'));
    }
}
