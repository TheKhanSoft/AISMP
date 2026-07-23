<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Faq as FaqModel;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Faq extends Component
{
    public function render()
    {
        return view('livewire.frontend.faq', [
            'faqs' => FaqModel::orderBy('order')->get(),
        ]);
    }
}
