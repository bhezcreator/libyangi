<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class InvitationShow extends Component
{
    public $slug;
    public $event;

    public $message;
    public $invite;
    public $reponse = 'Accepte';
    public $produits = [];

    public function mount($slug)
    {
        $this->slug = $slug;

        $this->event = Event::with([
            'theme',
            'products',
            'addresses',
        ])->where('slug', $slug)->firstOrFail();
    }

    public function submit()
    {
        $this->validate([
            'invite' => 'required|string|max:255',
            'message' => 'nullable|string|max:500',
            'reponse' => 'required|string',
        ]);

        $this->event->guests()->create([
            'name' => $this->invite,
            'message' => $this->message,
            'status' => $this->reponse,
            'code' => uniqid('G'),
        ]);

        session()->flash('success', 'Réponse envoyée avec succès !');

        $this->reset(['message', 'invite', 'reponse', 'produits']);
    }

    public function render()
    {
        return view('livewire.invitation-show');
    }
}
