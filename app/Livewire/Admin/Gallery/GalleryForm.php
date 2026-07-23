<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Gallery;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Gallery;

#[Layout('components.layouts.admin')]
#[Title('Form Gallery')]
class GalleryForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $title;
    public $image_count;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Gallery::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->title = $record->title;
            $this->image_count = $record->image_count;
        } else {
            $this->authorize('create', Gallery::class);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable',
            'image_count' => 'nullable',
        ]);

        $data = [
            'title' => $this->title,
            'image_count' => $this->image_count,
        ];

        if ($this->recordId) {
            $record = Gallery::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Gallery::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.gallery.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/gallery.gallery-form');
    }
}
