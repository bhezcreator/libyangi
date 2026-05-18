<div class="spm-settings-container">
    <div class="spm-settings-card">

        <!-- SIDEBAR TABS -->
        <div class="spm-settings-sidebar">

            <div class="spm-settings-tab 
                {{ $activeTab === 'tableau' ? 'active' : '' }}"
                wire:click="setTab('tableau')">
                <i class="las la-chart-pie"></i> Tableau de bord
            </div>
            
            <div class="spm-settings-tab 
                {{ $activeTab === 'event' ? 'active' : '' }}"
                wire:click="setTab('event')">
                <i class="las la-calendar-alt"></i> Evénement
            </div>

            @if (auth()->user()->hasRole('client'))
                <div class="spm-settings-tab 
                    {{ $activeTab === 'invite' ? 'active' : '' }}"
                    wire:click="setTab('invite')">
                    <i class="las la-envelope-open-text"></i> Invités & messages
                </div>
            @endif

            @if (auth()->user()->hasRole('admin'))
                <div class="spm-settings-tab 
                    {{ $activeTab === 'programme' ? 'active' : '' }}"
                    wire:click="setTab('programme')">
                    <i class="las la-list"></i> Programmes
                </div>
            @endif

            <div class="spm-settings-tab 
                {{ $activeTab === 'controleur' ? 'active' : '' }}"
                wire:click="setTab('controleur')">
                <i class="las la-user-shield"></i> Contrôleurs
            </div>

            @if (auth()->user()->hasRole('client'))
                <div class="spm-settings-tab {{ $activeTab === 'photo' ? 'active' : '' }}" wire:click="setTab('photo')">
                    <i class="las la-images"></i> Photos
                </div>
            @endif
        </div>

        <!-- CONTENT -->
        <div class="spm-settings-content">
            @if($activeTab === 'tableau')
                <livewire:event.stat-client-event :event_id="$id" />
            @endif

            @if($activeTab === 'event')
                <div class="spm-settings-panel">
                    @livewire('event.detail-vue-event', ['id' => $id]) 
                </div>
            @endif

            @if($activeTab === 'invite')
                <div class="spm-settings-panel">
                    
                </div>
            @endif

            @if($activeTab === 'programme')
                <div class="spm-settings-panel">
                    <livewire:programme :event_id="$id" />
                </div>
            @endif

            @if($activeTab === 'controleur')
                <div class="spm-settings-panel">
                    @if (Auth::user()->getRoleNames()->first() !== 'admin')
                        <livewire:event.my-controllers :event_id="$id" />
                    @else
                        <livewire:event.controllers-crud :event_id="$id" />
                    @endif
                </div>
            @endif

            @if($activeTab === 'photo')
                <div class="spm-settings-panel">
                    <livewire:event.media-crud :event_id="$id" />
                </div>
            @endif
        </div>

    </div>
</div>