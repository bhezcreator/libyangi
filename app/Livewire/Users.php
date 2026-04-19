<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $userId;
    public $name;
    public $email;
    public $password;

    public $roles = []; // rôles sélectionnés
    public $allRoles = [];

    public $search = '';

    public $isEdit = false;
    public $showModalInterne = false;
    public $confirmingDelete = false;
    public $deleteId;

    /* ========================
        INIT
    ========================*/
    public function mount()
    {
        $this->allRoles = Role::all();
    }

    /* ========================
        RULES
    ========================*/
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => $this->isEdit ? 'nullable|min:6' : 'required|min:6',
            'roles' => 'array'
        ];
    }

    /* ========================
        RENDER
    ========================*/
    public function render()
    {
        $users = User::with('roles')
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(5);

        return view('livewire.users', compact('users'));
    }

    /* ========================
        RESET
    ========================*/
    public function resetForm()
    {
        $this->reset([
            'userId',
            'name',
            'email',
            'password',
            'roles'
        ]);

        $this->isEdit = false;
    }

    /* ========================
        CREATE / UPDATE
    ========================*/
    public function save()
    {
        $this->validate();

        $user = User::updateOrCreate(
            ['id' => $this->userId],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password
                    ? Hash::make($this->password)
                    : User::find($this->userId)?->password
            ]
        );

        // 🔐 ATTACH ROLES
        $user->syncRoles($this->roles);

        $this->dispatch(
            'toast',
            type: 'success',
            message: $this->isEdit ? 'Utilisateur modifié' : 'Utilisateur créé'
        );

        $this->resetForm();
        $this->showModalInterne = false;
    }

    /* ========================
        EDIT
    ========================*/
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = null;

        $this->roles = $user->roles->pluck('name')->toArray();

        $this->isEdit = true;
        $this->showModalInterne = true;
    }

    /* ========================
        CREATE
    ========================*/
    public function create()
    {
        $this->resetForm();
        $this->showModalInterne = true;
    }

    /* ========================
        DELETE
    ========================*/
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function confirm()
    {
        User::findOrFail($this->deleteId)->delete();

        $this->confirmingDelete = false;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Utilisateur supprimé'
        );
    }
}
