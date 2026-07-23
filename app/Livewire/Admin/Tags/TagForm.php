<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Tags;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Tag;

#[Layout('components.layouts.admin')]
#[Title('Form Tags')]
class TagForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $name;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Tag::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->name = $record->name;
        } else {
            $this->authorize('create', Tag::class);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'nullable',
        ]);

        $data = [
            'name' => $this->name,
        ];

        if ($this->recordId) {
            $record = Tag::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Tag::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.tags.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/tags.tag-form');
    }
}
