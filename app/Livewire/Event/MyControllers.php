<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class MyControllers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $event_id;

    public $search = '';

    public function mount(Int $event_id)
    {
        $this->event_id = $event_id;
    }

    public function render()
    {
        $event = Event::findOrFail($this->event_id);

        $users = $event->controllers()

            ->where(function ($query) {

                $query
                    ->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            })

            ->latest()

            ->paginate(10);

        return view(
            'livewire.event.my-controllers',
            compact('users', 'event')
        );
    }
}
