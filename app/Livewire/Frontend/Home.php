<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\HeroSlide;
use App\Models\FeaturedSection;
use App\Models\Statistic;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\Partner;

#[Layout('layouts.app')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.frontend.home', [
            'heroSlides' => HeroSlide::where('is_active', 1)->orderBy('order')->get(),
            'featuredSections' => FeaturedSection::where('is_active', 1)->orderBy('order')->get(),
            'statistics' => Statistic::where('is_active', 1)->orderBy('order')->get(),
            'news' => News::where('is_published', 1)->latest()->take(3)->get(),
            'testimonials' => Testimonial::where('is_active', 1)->orderBy('order')->get(),
            'partners' => Partner::where('is_active', 1)->orderBy('order')->get(),
        ]);
    }
}
