<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $roleId;
    public $name;
    public $guard_name = 'web';

    public $search = '';

    public $isEdit = false;
    public $showModalInterne = false;

    public $confirmingDelete = false;
    public $deleteId;

    /* =========================
        RULES
    =========================*/
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:roles,name,' . $this->roleId,
            'guard_name' => 'required|string'
        ];
    }

    /* =========================
        RENDER
    =========================*/
    public function render()
    {
        $roles = Role::where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(5);

        return view('livewire.roles', compact('roles'));
    }

    /* =========================
        RESET
    =========================*/
    public function resetForm()
    {
        $this->reset([
            'roleId',
            'name',
            'guard_name'
        ]);

        $this->guard_name = 'web';
        $this->isEdit = false;
    }

    /* =========================
        CREATE / UPDATE
    =========================*/
    public function save()
    {
        $this->validate();

        Role::updateOrCreate(
            ['id' => $this->roleId],
            [
                'name' => $this->name,
                'guard_name' => $this->guard_name
            ]
        );

        $this->dispatch(
            'toast',
            type: 'success',
            message: $this->isEdit ? 'Rôle modifié' : 'Rôle créé'
        );

        $this->resetForm();
        $this->showModalInterne = false;
    }

    /* =========================
        EDIT
    =========================*/
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->guard_name = $role->guard_name;

        $this->isEdit = true;
        $this->showModalInterne = true;
    }

    /* =========================
        CREATE
    =========================*/
    public function create()
    {
        $this->resetForm();
        $this->showModalInterne = true;
    }

    /* =========================
        DELETE
    =========================*/
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function confirm()
    {
        Role::findOrFail($this->deleteId)->delete();

        $this->confirmingDelete = false;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Rôle supprimé'
        );
    }
}
