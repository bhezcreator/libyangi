<?php

namespace App\Livewire\Request;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends Component
{
    use WithFileUploads;

    public int $plan;
    public string $description = '';
    public $files = [];

    public function mount(int $plan)
    {
        $this->plan = $plan;
    }

    protected $rules = [
        'description' => 'required|string|max:1000',
        'files.*' => 'file|max:5120'
    ];

    // ✅ SUPPRIMER UN FICHIER AVANT UPLOAD
    public function removeFile($index)
    {
        unset($this->files[$index]);
        $this->files = array_values($this->files); // reindex
    }

    // ✅ ANNULER
    public function cancel()
    {
        return redirect()->route('home');
    }

    public function save()
    {
        $this->validate();

        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan_id' => $this->plan,
            'status' => 'pending'
        ]);

        $request = Request::create([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'status' => 'pending',
            'description' => $this->description
        ]);

        if ($this->files) {
            foreach ($this->files as $file) {

                $path = $file->store('requests');

                $request
                    ->addMedia(storage_path('app/' . $path))
                    ->usingName($file->getClientOriginalName())
                    ->toMediaCollection('requests');

                $request->mediase()->create([
                    'file' => $file->getClientOriginalName(),
                    'type' => $file->getMimeType(),
                ]);
            }
        }

        $this->dispatch('toast', type: 'success', message: 'Demande envoyée avec succès');

        return redirect()->route('demandes.index');
    }

    public function render()
    {
        return view('livewire.request.create-request');
    }
}
