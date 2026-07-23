<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Page;

#[Layout('components.layouts.admin')]
#[Title('Manage Pages')]
class PageList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function togglePublish(int $id): void
    {
        $this->authorize('update', Page::class);
        $page = Page::findOrFail($id);
        $page->is_published = !$page->is_published;
        $page->save();

        activity()->performedOn($page)->log($page->is_published ? 'published' : 'unpublished');
        $this->dispatch('notify', type: 'success', message: 'Page status updated.');
    }

    public function deletePage(int $id): void
    {
        $this->authorize('delete', Page::class);
        $page = Page::findOrFail($id);
        $page->delete();

        activity()->performedOn($page)->log('deleted');
        $this->dispatch('notify', type: 'success', message: 'Page deleted successfully.');
    }

    public function render()
    {
        $this->authorize('viewAny', Page::class);
        
        $pages = Page::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->status !== '', fn($q) => $q->where('is_published', $this->status))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.pages.page-list', [
            'pages' => $pages
        ]);
    }
}
