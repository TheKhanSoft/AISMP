<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Homepage;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\FeaturedSection;

#[Layout('components.layouts.admin')]
#[Title('Manage FeaturedSections')]
class FeaturedSectionList extends Component
{
    use WithPagination;

    public string $search = '';
    public array $selected = [];

    public function delete(int $id): void
    {
        $this->authorize('delete', FeaturedSection::class);
        $record = FeaturedSection::findOrFail($id);
        $record->delete();
        activity()->performedOn($record)->log('deleted');
        $this->dispatch('notify', type: 'success', message: 'Record deleted successfully.');
    }

    public function render()
    {
        $this->authorize('viewAny', FeaturedSection::class);
        $records = FeaturedSection::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%')->orWhere('name', 'like', '%' . $this->search . '%'))
            ->paginate(15);

        return view('livewire.admin/homepage.featured-section-list', compact('records'));
    }
}
