<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Plan;

class Plans extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $planId;
    public $name;
    public $price;
    public $max_guests;
    public $features = [];

    public $isEdit = false;
    public $showModalInterne = false;
    public $confirmingDelete = false;
    public $deleteId;

    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'max_guests' => 'required|integer',
            'features' => 'nullable'
        ];
    }

    /* ========================
        RENDER
    ========================*/
    public function render()
    {
        $plans = Plan::where('name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(5);

        return view('livewire.plans', compact('plans'));
    }

    /* ========================
        RESET
    ========================*/
    public function resetForm()
    {
        $this->reset([
            'planId',
            'name',
            'price',
            'max_guests',
            'features'
        ]);

        $this->isEdit = false;
    }

    /* ========================
        CREATE / UPDATE
    ========================*/
    public function save()
    {
        $this->validate();

        $features = is_array($this->features)
        ? $this->features
        : explode(',', $this->features);

        Plan::updateOrCreate(
            ['id' => $this->planId],
            [
                'name' => $this->name,
                'price' => $this->price,
                'max_guests' => $this->max_guests,
                'features' => $features
            ]
        );

        $this->dispatch(
            'toast',
            type: 'success',
            message: $this->isEdit ? 'Plan modifié' : 'Plan créé'
        );

        $this->resetForm();
        $this->showModalInterne = false;
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);

        $this->planId = $plan->id;
        $this->name = $plan->name;
        $this->price = $plan->price;
        $this->max_guests = $plan->max_guests;
        $this->features = $plan->features ?? [];

        $this->isEdit = true;
        $this->showModalInterne = true;
    }

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
        Plan::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Plan supprimé'
        );
    }
}
