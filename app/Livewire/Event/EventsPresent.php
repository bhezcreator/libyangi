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

    public $search = '';
    protected $paginationTheme = 'custom';

    public $confirmingDelete = false;
    public $deleteId;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ========================
        DELETE
    ========================*/
    public function confirmDelete(int $id)
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
            message: 'Event supprimé avec succès.'
        );
    }

    /**
     * Base query avec gestion des rôles
     */
    public function baseQuery()
    {
        $query = Event::query();

        $user = User::find(Auth::id());
        // Si ce n'est pas un admin
        if ($user->getRoleNames()->first() !== 'admin') {

            $query->where('user_id', $user->id)->where('status', 'publié');
        }

        return $query;
    }

    public function render()
    {
        $events = $this->baseQuery()
            ->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('type', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(6);

        return view('livewire.event.events-present', [
            'events' => $events
        ]);
    }
}
