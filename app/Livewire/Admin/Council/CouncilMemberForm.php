<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Council;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\CouncilMember;

#[Layout('components.layouts.admin')]
#[Title('Form CouncilMembers')]
class CouncilMemberForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $name;
    public $position;

    public function mount($id = null): void
    {
        if ($id) {
            $record = CouncilMember::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->name = $record->name;
            $this->position = $record->position;
        } else {
            $this->authorize('create', CouncilMember::class);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'nullable',
            'position' => 'nullable',
        ]);

        $data = [
            'name' => $this->name,
            'position' => $this->position,
        ];

        if ($this->recordId) {
            $record = CouncilMember::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = CouncilMember::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.council.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/council.council-member-form');
    }
}
