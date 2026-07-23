<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Page;

#[Layout('components.layouts.admin')]
#[Title('Page Form')]
class PageForm extends Component
{
    use WithFileUploads;

    public ?int $pageId = null;
    public string $title = '';
    public string $slug = '';
    public string $content = '';
    public ?string $excerpt = null;
    public string $template = 'default';
    public ?string $meta_title = null;
    public ?string $meta_description = null;
    public ?string $meta_keywords = null;
    public $featured_image;
    public $current_image_url;
    public bool $is_published = false;

    public function mount($id = null): void
    {
        if ($id) {
            $page = Page::findOrFail($id);
            $this->authorize('update', $page);
            
            $this->pageId = $page->id;
            $this->title = $page->title;
            $this->slug = $page->slug;
            $this->content = $page->content;
            $this->excerpt = $page->excerpt;
            $this->template = $page->template ?? 'default';
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->meta_keywords = $page->meta_keywords;
            $this->is_published = (bool)$page->is_published;
            
            // Assuming Spatie Media Library is used
            if ($page->hasMedia('featured_image')) {
                $this->current_image_url = $page->getFirstMediaUrl('featured_image');
            }
        } else {
            $this->authorize('create', Page::class);
        }
    }

    public function updatedTitle(): void
    {
        if (empty($this->slug)) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $this->pageId,
            'content' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'template' => 'nullable|string|max:50',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        // Separate image from db fields
        unset($validated['featured_image']);
        
        $action = $this->pageId ? 'updated' : 'created';

        if ($this->pageId) {
            $page = Page::findOrFail($this->pageId);
            $page->update($validated);
        } else {
            $page = Page::create($validated);
        }

        // Handle image upload with Spatie Media Library
        if ($this->featured_image) {
            $page->clearMediaCollection('featured_image');
            $page->addMedia($this->featured_image->getRealPath())
                 ->usingName($this->featured_image->getClientOriginalName())
                 ->toMediaCollection('featured_image');
        }

        activity()->performedOn($page)->log($action);
        $this->dispatch('notify', type: 'success', message: 'Page ' . $action . ' successfully.');
        
        return $this->redirect(route('admin.pages.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.pages.page-form');
    }
}
