<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class NewsList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.frontend.news-list', [
            'newsItems' => News::with('user', 'category')->where('is_published', true)->orderBy('published_at', 'desc')->paginate(9),
        ]);
    }
}
