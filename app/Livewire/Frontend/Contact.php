<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.app')]
class Contact extends Component
{
    #[Validate('required|min:3')]
    public $name = '';
    
    #[Validate('required|email')]
    public $email = '';
    
    #[Validate('required|min:5')]
    public $subject = '';
    
    #[Validate('required|min:10')]
    public $message = '';

    public function submit()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'is_read' => false,
        ]);

        session()->flash('success', 'Your message has been sent successfully. We will get back to you soon!');

        $this->reset(['name', 'email', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.frontend.contact');
    }
}
