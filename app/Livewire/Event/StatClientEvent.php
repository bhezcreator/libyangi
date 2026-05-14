<?php

namespace App\Livewire\Event;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StatClientEvent extends Component
{
    public Int $event_id;

    public String $status = "";

    public $guestsCount = 0;
    public $productsCount = 0;

    public function mount(int $event_id)
    {
        $this->event_id = $event_id;

        $this->loadStats();
    }

    /**
     * Event sécurisé (client / admin)
     */
    public function getEvent()
    {
        $query = Event::with(['guests', 'products']);

        $user = User::find(Auth::id());
        // Si ce n'est pas un admin
        if ($user->getRoleNames()->first() !== 'admin') {
            $query->where('user_id', $user->id);
        }

        return $query->where('id', $this->event_id)->first();
    }

    public function loadStats()
    {
        $today = Carbon::today();

        $event = $this->getEvent();

        if (! $event) {
            $this->status = "";
            $this->guestsCount = 0;
            $this->productsCount = 0;
            return;
        }

        /**
         * STATUS EVENT
         */
        if (Carbon::parse($event->start_date)->gt($today)) {
            $this->status = 'A venir';
        } elseif (
            Carbon::parse($event->start_date)->lte($today)
            && Carbon::parse($event->end_date)->gte($today)
        ) {
            $this->status = 'En cours';
        } else {
            $this->status = 'Passée';
        }

        /**
         * RELATIONS STATS
         */
        $this->guestsCount = $event->guests->count();
        $this->productsCount = $event->products->count();
    }

    public function render()
    {
        return view('livewire.event.stat-client-event');
    }
}
