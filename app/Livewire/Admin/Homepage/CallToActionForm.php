<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Homepage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\CallToAction;

#[Layout('components.layouts.admin')]
#[Title('Form CallToActions')]
class CallToActionForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $title;
    public $url;

    public function mount($id = null): void
    {
        if ($id) {
            $record = CallToAction::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->title = $record->title;
            $this->url = $record->url;
        } else {
            $this->authorize('create', CallToAction::class);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable',
            'url' => 'nullable',
        ]);

        $data = [
            'title' => $this->title,
            'url' => $this->url,
        ];

        if ($this->recordId) {
            $record = CallToAction::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = CallToAction::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.homepage.call-to-actions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/homepage.call-to-action-form');
    }
}
