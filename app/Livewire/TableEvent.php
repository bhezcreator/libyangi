<?php

namespace App\Livewire;

use Livewire\Component;

class TableEvent extends Component
{
    public string $activeTab = 'tableau';

    // Permet de synchroniser $activeTab avec la query string
    protected $queryString = ['activeTab'];

    public function setTab(String $tab)
    {
        $this->activeTab = $tab;
    }
    public function render()
    {
        return view('livewire.table-event');
    }
}
