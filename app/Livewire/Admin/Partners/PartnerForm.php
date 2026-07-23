<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Partners;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Partner;

#[Layout('components.layouts.admin')]
#[Title('Form Partners')]
class PartnerForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $name;
    public $logo;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Partner::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->name = $record->name;
            $this->logo = $record->logo;
        } else {
            $this->authorize('create', Partner::class);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'nullable',
            'logo' => 'nullable',
        ]);

        $data = [
            'name' => $this->name,
            'logo' => $this->logo,
        ];

        if ($this->recordId) {
            $record = Partner::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Partner::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.partners.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/partners.partner-form');
    }
}
