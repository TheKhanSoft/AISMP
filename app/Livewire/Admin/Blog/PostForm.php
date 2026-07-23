<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Post;

#[Layout('components.layouts.admin')]
#[Title('Form BlogPosts')]
class PostForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $title;
    public $category_id;
    public $status;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Post::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->title = $record->title;
            $this->category_id = $record->category_id;
            $this->status = $record->status;
        } else {
            $this->authorize('create', Post::class);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable',
            'category_id' => 'nullable',
            'status' => 'nullable',
        ]);

        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'status' => $this->status,
        ];

        if ($this->recordId) {
            $record = Post::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Post::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.blog.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/blog.post-form');
    }
}
