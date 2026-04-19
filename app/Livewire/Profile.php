<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $user;
    public $name;
    public $email;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $this->user = User::find(Auth::id());

        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email'
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('success', 'Profil mis à jour avec succès.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Mot de passe actuel incorrect.');
            return;
        }

        $this->user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->reset([
            'current_password',
            'new_password',
            'new_password_confirmation'
        ]);

        session()->flash('success_password', 'Mot de passe modifié avec succès.');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
