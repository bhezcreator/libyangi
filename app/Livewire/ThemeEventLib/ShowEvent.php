<?php

namespace App\Livewire\ThemeEventLib;

use App\Models\Event;
use Livewire\Component;

class ShowEvent extends Component
{
    public Event $event;

    public $loaded = false;

    public function mount($slug)
    {
        $this->event = Event::with([
            'addresses',
            'guests',
            'products',
            'theme',
            'controllers'
        ])->where('slug', $slug)->firstOrFail();

        $this->loaded = true;
    }

    public function sendInvitation()
    {
        $this->dispatch(
            'theme-event-lib-send-invitation',
            eventId: $this->event->id
        );

        session()->flash(
            'success',
            'Invitation envoyée avec succès.'
        );
    }

    public function render()
    {
        $products = $this->event
            ->products
            ->groupBy(fn($product) => $product->category->name ?? 'Autres');

        return view('livewire.theme-event-lib.show-event', [
            'productsByCategory' => $products
        ]);
    }
}
