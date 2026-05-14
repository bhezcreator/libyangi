<div class="app-container-element">

    <x-form.select
        label="Année"
        wire:model.live="annee"
        :options="collect(range(date('Y'), date('Y') + 10))
            ->mapWithKeys(fn($year) => [$year => $year])
            ->toArray()"
    />

    <div class="stats-container">

        <div class="stat-card upcoming">
            <div class="icon">
                <i class="las la-calendar-alt"></i>
            </div>

            <div class="content">
                <h3>{{ $upcomingEvents }}</h3>
                <p>Événements à venir</p>
            </div>
        </div>

        <div class="stat-card ongoing">
            <div class="icon">
                <i class="las la-play-circle"></i>
            </div>

            <div class="content">
                <h3>{{ $ongoingEvents }}</h3>
                <p>Événements en cours</p>
            </div>
        </div>

        <div class="stat-card past">
            <div class="icon">
                <i class="las la-check-circle"></i>
            </div>

            <div class="content">
                <h3>{{ $pastEvents }}</h3>
                <p>Événements passés</p>
            </div>
        </div>

    </div>

    <!-- GRAPHIQUE --> <br>
    <div class="somm-chart-card">

        <div class="somm-chart-header">
            <h3>Événements par mois</h3>
        </div>

        <div
            wire:ignore
            x-data="chartComponent(@js($chart))"
            x-init="init()"
            x-on:update-chart.window="update($event.detail.chart)"
            class="somm-form-chart-container"
        ></div>

    </div>

</div>