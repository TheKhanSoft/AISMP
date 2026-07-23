<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Homepage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use App\Models\HeroSlide;

#[Layout('components.layouts.admin')]
#[Title('Hero Slide Form')]
class HeroSlideForm extends Component
{
    use WithFileUploads;

    public ?int $slideId = null;
    public string $title = '';
    public ?string $subtitle = null;
    public ?string $button_text = null;
    public ?string $button_url = null;
    public bool $is_active = true;
    public $image;
    public $current_image_url;

    public function mount($id = null): void
    {
        if ($id) {
            $slide = HeroSlide::findOrFail($id);
            $this->authorize('update', $slide);
            
            $this->slideId = $slide->id;
            $this->title = $slide->title;
            $this->subtitle = $slide->subtitle;
            $this->button_text = $slide->button_text;
            $this->button_url = $slide->button_url;
            $this->is_active = (bool)$slide->is_active;
            
            if ($slide->hasMedia('image')) {
                $this->current_image_url = $slide->getFirstMediaUrl('image');
            }
        } else {
            $this->authorize('create', HeroSlide::class);
        }
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'image' => $this->slideId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        unset($validated['image']);
        
        if (!$this->slideId) {
            $maxOrder = HeroSlide::max('sort_order') ?? 0;
            $validated['sort_order'] = $maxOrder + 1;
        }
        
        $action = $this->slideId ? 'updated' : 'created';

        if ($this->slideId) {
            $slide = HeroSlide::findOrFail($this->slideId);
            $slide->update($validated);
        } else {
            $slide = HeroSlide::create($validated);
        }

        if ($this->image) {
            $slide->clearMediaCollection('image');
            $slide->addMedia($this->image->getRealPath())
                 ->usingName($this->image->getClientOriginalName())
                 ->toMediaCollection('image');
        }

        activity()->performedOn($slide)->log($action);
        $this->dispatch('notify', type: 'success', message: 'Slide ' . $action . ' successfully.');
        
        return $this->redirect(route('admin.homepage.hero-slides.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.homepage.hero-slide-form');
    }
}
