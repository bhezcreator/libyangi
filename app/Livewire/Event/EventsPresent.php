<?php

namespace App\Livewire\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EventsPresent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'costum';

    public $search = '';
    public $type = '';
    public $status = '';

    public $confirmingDelete = false;
    public $deleteId = null;

    protected $queryString = [
        'search',
        'type',
        'status'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingType()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | RESET FILTERS
    |--------------------------------------------------------------------------
    */

    public function resetFilters()
    {
        $this->reset([
            'search',
            'type',
            'status'
        ]);

        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function confirm()
    {
        $event = $this->baseQuery()->findOrFail($this->deleteId);

        $event->delete();

        $this->confirmingDelete = false;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Événement supprimé avec succès.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | BASE QUERY
    |--------------------------------------------------------------------------
    */

    public function baseQuery()
    {
        $query = Event::query()
            ->with([
                'theme',
                'guests',
                'addresses'
            ]);

        $user = User::find(Auth::id());

        if ($user->getRoleNames()->first() !== 'admin') {

            $query->where('user_id', $user->id);
        }

        return $query;
    }

    public function render()
    {
        $events = $this->baseQuery()

            ->when($this->search, function ($query) {

                $query->where(function ($q) {

                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('type', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })

            ->when($this->type, function ($query) {

                $query->where('type', $this->type);
            })

            ->when($this->status, function ($query) {

                $query->where('status', $this->status);
            })

            ->latest()
            ->paginate(10);

        $types = Event::select('type')
            ->distinct()
            ->pluck('type');

        return view('livewire.event.events-present', [
            'events' => $events,
            'types' => $types
        ]);
    }
}
