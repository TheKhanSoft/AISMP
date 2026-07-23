<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\News;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class NewsDetails extends Component
{
    public News $news;

    public function mount(News $news)
    {
        if (!$news->is_published) {
            abort(404);
        }
        $this->news = $news;
        $this->news->increment('views_count');
    }

    public function render()
    {
        return view('livewire.frontend.news-details');
    }
}
