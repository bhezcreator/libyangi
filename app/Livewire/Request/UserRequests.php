<?php

namespace App\Livewire\Request;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class UserRequests extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    protected $queryString = ['search'];

    // MODAL
    public $selectedRequest = null;
    public $showModalInterne = false;

    // DELETE
    public $confirmingDelete = false;
    public $deleteId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // ✅ OUVRIR MODAL
    public function show(Int $id)
    {
        $this->showModalInterne = true;
        $this->selectedRequest = Request::with(['subscription.plan', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
    }

    // ✅ CONFIRM DELETE
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $request = Request::where('user_id', Auth::id())
            ->findOrFail($this->deleteId);

        $request->delete();

        $this->confirmingDelete = false;

        session()->flash('success', 'Demande supprimée');
    }

    public function render()
    {
        $requests = Request::with(['subscription.plan'])
            ->where('user_id', Auth::id())
            ->where(function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.request.user-requests', compact('requests'));
    }
}
