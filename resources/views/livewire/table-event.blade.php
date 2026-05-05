
<div class="spm-settings-container">
    <div class="spm-settings-card">

        <!-- SIDEBAR TABS -->
        <div class="spm-settings-sidebar">

            <div class="spm-settings-tab 
                {{ $activeTab === 'tableau' ? 'active' : '' }}"
                wire:click="setTab('tableau')">
                <i class="las la-user"></i> Tableau de bord
            </div>

            <div class="spm-settings-tab 
                {{ $activeTab === 'event' ? 'active' : '' }}"
                wire:click="setTab('event')">
                <i class="la la-users"></i> Evénements
            </div>

        </div>

        <!-- CONTENT -->
        <div class="spm-settings-content">
            @if($activeTab === 'tableau')
                <div class="spm-settings-panel">
                    <div class="stats-container">

                        <!-- Event à venir -->
                        <div class="stat-card upcoming">
                            <div class="icon">
                                <i class="las la-calendar-alt"></i>
                            </div>
                            <div class="content">
                                <h3>{{ $upcomingEvents ?? 12 }}</h3>
                                <p>Événements à venir</p>
                            </div>
                        </div>

                        <!-- Event en cours -->
                        <div class="stat-card ongoing">
                            <div class="icon">
                                <i class="las la-play-circle"></i>
                            </div>
                            <div class="content">
                                <h3>{{ $ongoingEvents ?? 5 }}</h3>
                                <p>Événements en cours</p>
                            </div>
                        </div>

                        <!-- Event passé -->
                        <div class="stat-card past">
                            <div class="icon">
                                <i class="las la-check-circle"></i>
                            </div>
                            <div class="content">
                                <h3>{{ $pastEvents ?? 30 }}</h3>
                                <p>Événements passés</p>
                            </div>
                        </div>

                    </div>

                </div>
            @endif

            @if($activeTab === 'event')
                <div class="spm-settings-panel">
                    @livewire('events.events-present')
                </div>
            @endif

        </div>

    </div>
</div>