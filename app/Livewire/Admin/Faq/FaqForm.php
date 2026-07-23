<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Faq;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Faq;

#[Layout('components.layouts.admin')]
#[Title('Form Faqs')]
class FaqForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $question;
    public $category_id;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Faq::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->question = $record->question;
            $this->category_id = $record->category_id;
        } else {
            $this->authorize('create', Faq::class);
        }
    }

    public function save()
    {
        $this->validate([
            'question' => 'nullable',
            'category_id' => 'nullable',
        ]);

        $data = [
            'question' => $this->question,
            'category_id' => $this->category_id,
        ];

        if ($this->recordId) {
            $record = Faq::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Faq::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.faq.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/faq.faq-form');
    }
}
