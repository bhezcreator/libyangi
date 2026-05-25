<?php

namespace App\Livewire;

use App\Models\Programmes;
use Livewire\Component;
use Livewire\WithPagination;

class Programme extends Component
{
    use WithPagination;

    protected $paginationTheme = 'custom';

    public $programmeId;
    public $event_id;
    public $titre;
    public $detail;
    public $type;
    public $icone;
    public $date_heure;
    public $order;

    public $isEdit = false;
    public $showModalInterne = false;
    public $confirmingDelete = false;
    public $deleteId;

    public $search = '';

    protected function rules()
    {
        return [
            'event_id' => 'required|exists:events,id',
            'titre' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'type' => 'required|string',
            'icone' => 'nullable|string',
            'date_heure' => 'required|date',
            'order' => 'required|integer',
        ];
    }

    public function mount(Int $event_id)
    {
        $this->event_id = $event_id;
    }

    public function render()
    {
        $programmes = Programmes::where('titre', 'like', "%{$this->search}%")
            ->where('event_id', $this->event_id)
            ->latest()
            ->paginate(5);

        return view('livewire.programme', compact('programmes'));
    }

    /* ========================
        RESET
    ========================*/
    public function resetForm()
    {
        $this->reset([
            'programmeId',
            'titre',
            'detail',
            'type',
            'icone',
            'order',
            'date_heure'
        ]);

        $this->isEdit = false;
    }

    /* ========================
        CREATE / UPDATE
    ========================*/
    public function save()
    {
        $this->validate();

        Programmes::updateOrCreate(
            ['id' => $this->programmeId],
            [
                'event_id' => $this->event_id,
                'titre' => $this->titre,
                'detail' => $this->detail,
                'type' => $this->type,
                'icone' => $this->icone,
                'order' => $this->order,
                'date_heure' => $this->date_heure
            ]
        );

        $this->dispatch(
            'toast',
            type: 'success',
            message: $this->isEdit ? 'Programme modifié' : 'Programme créé'
        );

        $this->resetForm();
        $this->showModalInterne = false;
    }

    public function edit(Int $id)
    {
        $pro = Programmes::findOrFail($id);

        $this->programmeId = $pro->id;
        $this->titre = $pro->titre;
        $this->detail = $pro->detail;
        $this->type = $pro->type;
        $this->icone = $pro->icone;
        $this->order = $pro->order;
        $this->date_heure = $pro->date_heure;

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
    public function confirmDelete(Int $id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function confirm()
    {
        Programmes::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Plan supprimé'
        );
    }
}
