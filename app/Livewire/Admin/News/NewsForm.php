<?php
declare(strict_types=1);

namespace App\Livewire\Admin\News;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\News;

#[Layout('components.layouts.admin')]
#[Title('Form News')]
class NewsForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $title;
    public $category_id;
    public $status;
    public $published_at;

    public function mount($id = null): void
    {
        if ($id) {
            $record = News::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->title = $record->title;
            $this->category_id = $record->category_id;
            $this->status = $record->status;
            $this->published_at = $record->published_at;
        } else {
            $this->authorize('create', News::class);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable',
            'category_id' => 'nullable',
            'status' => 'nullable',
            'published_at' => 'nullable',
        ]);

        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'published_at' => $this->published_at,
        ];

        if ($this->recordId) {
            $record = News::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = News::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.news.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/news.news-form');
    }
}
