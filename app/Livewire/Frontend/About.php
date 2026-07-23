<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Page;
use App\Models\CouncilMember;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class About extends Component
{
    public function render()
    {
        return view('livewire.frontend.about', [
            'page' => Page::where('slug', 'about')->first(),
            'councilMembers' => CouncilMember::where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}
