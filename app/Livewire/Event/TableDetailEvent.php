<?php

namespace App\Livewire\Event;

use Livewire\Component;

class TableDetailEvent extends Component
{
    public string $activeTab = 'tableau';
    public int $id;

    // Permet de synchroniser $activeTab avec la query string
    protected $queryString = ['activeTab'];

    public function mount($id)
    {
        $this->id = $id;
    }

    public function setTab(String $tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.event.table-detail-event');
    }
}
