<?php

namespace App\Livewire\Event;

use App\Models\User;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class ControllersCrud extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $event_id;
    public $search = '';

    public function mount(Int $event_id)
    {
        $this->event_id = $event_id;
    }

    /* ========================
        ATTRIBUER / RETIRER
    ========================*/
    public function toggleController(Int $user_id)
    {
        $event = Event::findOrFail($this->event_id);

        if ($event->controllers()->where('user_id', $user_id)->exists()) {
            $event->controllers()->detach($user_id);
            $message = 'Contrôleur retiré';
        } else {
            $event->controllers()->attach($user_id);
            $message = 'Contrôleur attribué';
        }

        $this->dispatch(
            'toast',
            type: 'success',
            message: $message
        );
    }

    /* ========================
        CHECK
    ========================*/
    public function isController($userId)
    {
        return Event::find($this->event_id)
            ->controllers()
            ->where('user_id', $userId)
            ->exists();
    }

    /* ========================
        RENDER
    ========================*/
    public function render()
    {
        $users = User::where(function ($query) {
            $query
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%");
        })
            ->latest()
            ->paginate(10);

        return view(
            'livewire.event.controllers-crud',
            compact('users')
        );
    }
}
