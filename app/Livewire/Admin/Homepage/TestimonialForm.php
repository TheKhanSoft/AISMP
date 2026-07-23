<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Homepage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Testimonial;

#[Layout('components.layouts.admin')]
#[Title('Form Testimonials')]
class TestimonialForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $name;
    public $role;
    public $content;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Testimonial::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->name = $record->name;
            $this->role = $record->role;
            $this->content = $record->content;
        } else {
            $this->authorize('create', Testimonial::class);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'nullable',
            'role' => 'nullable',
            'content' => 'nullable',
        ]);

        $data = [
            'name' => $this->name,
            'role' => $this->role,
            'content' => $this->content,
        ];

        if ($this->recordId) {
            $record = Testimonial::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Testimonial::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.homepage.testimonials.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/homepage.testimonial-form');
    }
}
