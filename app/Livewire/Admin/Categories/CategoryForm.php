<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Category;

#[Layout('components.layouts.admin')]
#[Title('Form Categories')]
class CategoryForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $name;
    public $type;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Category::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->name = $record->name;
            $this->type = $record->type;
        } else {
            $this->authorize('create', Category::class);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'nullable',
            'type' => 'nullable',
        ]);

        $data = [
            'name' => $this->name,
            'type' => $this->type,
        ];

        if ($this->recordId) {
            $record = Category::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Category::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.categories.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/categories.category-form');
    }
}
