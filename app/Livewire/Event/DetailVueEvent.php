<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class DetailVueEvent extends Component
{
    public Event $event;

    public function mount(Int $id)
    {
        $this->event = Event::with([
            'user',
            'subscription',
            'theme',
            'guests',
            'products',
            'addresses'
        ])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.event.detail-vue-event');
    }
}
