<?php

namespace App\Livewire\Events;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;

class EventsPresent extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Int $id)
    {
        Event::findOrFail($id)->delete();
        session()->flash('message', 'Event supprimé avec succès.');
    }

    public function render()
    {
        $events = Event::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('type', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(6);

        return view('livewire.events.events-present', [
            'events' => $events
        ]);
    }
}
