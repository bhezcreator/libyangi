<?php

namespace App\Livewire\Request;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Request;
use Illuminate\Support\Facades\Redirect;

class AdminRequest extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $search = '';

    protected $queryString = ['search'];

    // MODAL
    public $selectedRequest = null;
    public $showModalInterne = false;

    // STATUS
    public $status;

    // DELETE
    public $confirmingDelete = false;
    public $deleteId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // VIEW
    public function show(Int $id)
    {
        $this->selectedRequest = Request::with(['subscription.plan', 'user'])
            ->findOrFail($id);

        $this->status = $this->selectedRequest->status;
        $this->showModalInterne = true;
    }

    // UPDATE STATUS (LIVE)
    public function updatedStatus()
    {
        if (!$this->selectedRequest) return;

        $this->selectedRequest->update([
            'status' => $this->status
        ]);

        // 🔥 si APPROVED => redirect
        if ($this->status === 'approved') {
            return redirect()->route('events.add', [
                'subscription_id' => $this->selectedRequest->subscription_id,
                'user_id' => $this->selectedRequest->user_id
            ]);
        }
    }

    // DELETE
    public function confirmDelete(Int $id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $request = Request::with('media')->findOrFail($this->deleteId);

        // 🔥 supprimer media Spatie automatiquement
        $request->clearMediaCollection('requests');

        $request->delete();

        $this->confirmingDelete = false;
    }

    public function render()
    {
        $requests = Request::with(['subscription.plan', 'user'])
            ->where(function ($q) {
                $q->where('description', 'like', "%{$this->search}%")
                    ->orWhere('status', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('livewire.request.admin-request', compact('requests'));
    }
}
