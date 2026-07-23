<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Homepage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\FeaturedSection;

#[Layout('components.layouts.admin')]
#[Title('Form FeaturedSections')]
class FeaturedSectionForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $title;
    public $status;

    public function mount($id = null): void
    {
        if ($id) {
            $record = FeaturedSection::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->title = $record->title;
            $this->status = $record->status;
        } else {
            $this->authorize('create', FeaturedSection::class);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable',
            'status' => 'nullable',
        ]);

        $data = [
            'title' => $this->title,
            'status' => $this->status,
        ];

        if ($this->recordId) {
            $record = FeaturedSection::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = FeaturedSection::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.homepage.featured-sections.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/homepage.featured-section-form');
    }
}
