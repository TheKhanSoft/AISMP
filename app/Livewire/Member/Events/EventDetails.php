<?php

namespace App\Livewire\Member\Events;

use Livewire\Component;

class EventDetails extends Component
{
    public $event;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.member.events.event-details');
    }
}
