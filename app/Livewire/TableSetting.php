<?php

namespace App\Livewire;

use Livewire\Component;

class TableSetting extends Component
{
    public string $activeTab = 'Profil';

    // Permet de synchroniser $activeTab avec la query string
    protected $queryString = ['activeTab'];

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.table-setting');
    }
}
