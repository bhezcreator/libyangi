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

    public Int $plan; // ID du plan
    public string $description;
    public $files = [];

    public function mount(Int $plan)
    {
        $this->plan = $plan;
    }

    protected $rules = [
        'description' => 'required|string|max:1000',
        'files.*' => 'file|max:5120'
    ];

    public function save()
    {
        $this->validate();

        // 1. Créer la souscription
        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan_id' => $this->plan,
            'status' => 'pending'
        ]);

        // 2. Créer la demande
        $request = Request::create([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'status' => 'pending',
            'description' => $this->description
        ]);

        // 3. Upload des fichiers avec Spatie Medialibrary
        if ($this->files) {
            foreach ($this->files as $file) {
                // 1. Stocker d'abord le fichier
                $path = $file->store('requests');

                // 2. Ensuite l'envoyer à Spatie
                $request
                    ->addMedia(storage_path('app/' . $path))
                    ->usingName($file->getClientOriginalName())
                    ->toMediaCollection('requests');

                // Optionnel si tu veux garder ta table RequestMedia
                $request->mediase()->create([
                    'file' => $file->getClientOriginalName(),
                    'type' => $file->getMimeType(),
                ]);
            }
        }

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Demande envoyée avec succès'
        );

        return redirect()->route('demandes');
    }

    public function render()
    {
        return view('livewire.request.create-request');
    }
}
