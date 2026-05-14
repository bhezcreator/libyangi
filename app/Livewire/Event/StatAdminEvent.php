<?php

namespace App\Livewire\Event;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class StatAdminEvent extends Component
{
    public String $annee;

    public $upcomingEvents = 0;
    public $ongoingEvents = 0;
    public $pastEvents = 0;

    public $chart = [];

    public function mount()
    {
        $this->annee = date('Y');

        $this->loadStats();
        $this->loadChart();
    }

    public function updatedAnnee()
    {
        $this->loadStats();
        $this->loadChart();
    }

    /**
     * Base query selon le rôle
     */
    public function eventQuery()
    {
        $query = Event::query();
        $user = User::find(Auth::id());
        // Si ce n'est pas un admin
        if ($user->getRoleNames()->first() !== 'admin') {

            // Afficher uniquement les événements du client connecté
            $query->where('user_id', $user->id);
        }

        return $query;
    }

    public function loadStats()
    {
        $today = Carbon::today();

        // Événements à venir
        $this->upcomingEvents = $this->eventQuery()
            ->whereYear('start_date', $this->annee)
            ->whereDate('start_date', '>', $today)
            ->count();

        // Événements en cours
        $this->ongoingEvents = $this->eventQuery()
            ->whereYear('start_date', $this->annee)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        // Événements passés
        $this->pastEvents = $this->eventQuery()
            ->whereYear('end_date', $this->annee)
            ->whereDate('end_date', '<', $today)
            ->count();
    }

    public function loadChart()
    {
        $months = [
            1 => 'Jan',
            2 => 'Fév',
            3 => 'Mar',
            4 => 'Avr',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juil',
            8 => 'Août',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Déc',
        ];

        $data = [];

        foreach ($months as $monthNumber => $monthName) {

            $count = $this->eventQuery()
                ->whereYear('start_date', $this->annee)
                ->whereMonth('start_date', $monthNumber)
                ->count();

            $data[] = $count;
        }

        $this->chart = [
            'series' => [
                [
                    'name' => 'Événements',
                    'data' => $data
                ]
            ],

            'categories' => array_values($months)
        ];

        $this->dispatch('updateChart', chart: $this->chart);
    }

    public function render()
    {
        return view('livewire.event.stat-admin-event');
    }
}
