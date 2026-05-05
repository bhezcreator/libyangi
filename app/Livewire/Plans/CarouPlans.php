<?php

namespace App\Livewire\Plans;

use Livewire\Component;
use App\Models\Plan;

class CarouPlans extends Component
{
    public $plans = [];
    public $currentIndex = 0;

    public function mount()
    {
        $this->plans = Plan::all()->toArray();
    }

    public function next()
    {
        if (count($this->plans) === 0) return;

        $this->currentIndex = ($this->currentIndex + 1) % count($this->plans);
    }

    public function prev()
    {
        if (count($this->plans) === 0) return;

        $this->currentIndex = ($this->currentIndex - 1 + count($this->plans)) % count($this->plans);
    }

    public function render()
    {
        return view('livewire.plans.carou-plans');
    }
}
