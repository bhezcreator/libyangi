<?php

namespace App\Livewire\ThemeEventLib;

use App\Models\Event;
use Livewire\Component;

class ShowInviteMar extends Component
{
    public Event $event;

    public $loaded = false;
    public $isPrivate = false;

    /*         protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'max_guests' => 'required|integer',
            'features' => 'nullable'
        ]; 'declined'
    } */

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


    public function updatedIsPrivate()
    {
        if ($this->isPrivate) {
            $this->isPrivate = true;
        } else {
            $this->isPrivate = false;
        }
    }

    /* ========================
        RESET
    ========================*/
    /*     public function resetForm()
    {
        $this->reset([
            'planId',
            'name',
            'price',
            'max_guests',
            'features'
        ]);
    } */

    /* ========================
        CREATE
    ========================*/
    public function save()
    {
        // $this->validate();

        // $this->resetForm();
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
        return view('livewire.theme-event-lib.show-invite-mar');
    }
}
