<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Homepage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\HeroSlide;

#[Layout('components.layouts.admin')]
#[Title('Manage Hero Slides')]
class HeroSlideList extends Component
{
    public function toggleActive(int $id): void
    {
        $this->authorize('update', HeroSlide::class);
        $slide = HeroSlide::findOrFail($id);
        $slide->is_active = !$slide->is_active;
        $slide->save();

        activity()->performedOn($slide)->log($slide->is_active ? 'activated' : 'deactivated');
        $this->dispatch('notify', type: 'success', message: 'Slide status updated.');
    }

    public function deleteSlide(int $id): void
    {
        $this->authorize('delete', HeroSlide::class);
        $slide = HeroSlide::findOrFail($id);
        $slide->delete();

        activity()->performedOn($slide)->log('deleted');
        $this->dispatch('notify', type: 'success', message: 'Slide deleted successfully.');
    }

    public function moveUp(int $id): void
    {
        $this->authorize('update', HeroSlide::class);
        $slide = HeroSlide::findOrFail($id);
        $previousSlide = HeroSlide::where('sort_order', '<', $slide->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if ($previousSlide) {
            $temp = $slide->sort_order;
            $slide->sort_order = $previousSlide->sort_order;
            $previousSlide->sort_order = $temp;
            $slide->save();
            $previousSlide->save();
        }
    }

    public function moveDown(int $id): void
    {
        $this->authorize('update', HeroSlide::class);
        $slide = HeroSlide::findOrFail($id);
        $nextSlide = HeroSlide::where('sort_order', '>', $slide->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($nextSlide) {
            $temp = $slide->sort_order;
            $slide->sort_order = $nextSlide->sort_order;
            $nextSlide->sort_order = $temp;
            $slide->save();
            $nextSlide->save();
        }
    }

    public function render()
    {
        $this->authorize('viewAny', HeroSlide::class);
        
        $slides = HeroSlide::orderBy('sort_order', 'asc')->get();

        return view('livewire.admin.homepage.hero-slide-list', [
            'slides' => $slides
        ]);
    }
}
