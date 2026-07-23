<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;

#[Layout('components.layouts.admin')]
#[Title('Manage BlogPosts')]
class PostList extends Component
{
    use WithPagination;

    public string $search = '';
    public array $selected = [];

    public function delete(int $id): void
    {
        $this->authorize('delete', Post::class);
        $record = Post::findOrFail($id);
        $record->delete();
        activity()->performedOn($record)->log('deleted');
        $this->dispatch('notify', type: 'success', message: 'Record deleted successfully.');
    }

    public function render()
    {
        $this->authorize('viewAny', Post::class);
        $records = Post::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%')->orWhere('name', 'like', '%' . $this->search . '%'))
            ->paginate(15);

        return view('livewire.admin/blog.post-list', compact('records'));
    }
}
