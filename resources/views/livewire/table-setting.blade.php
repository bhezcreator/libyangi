
<div class="spm-settings-container">
    <div class="spm-settings-card">

        <!-- SIDEBAR TABS -->
        <div class="spm-settings-sidebar">

            <div class="spm-settings-tab 
                {{ $activeTab === 'Profil' ? 'active' : '' }}"
                wire:click="setTab('Profil')">
                <i class="las la-user"></i> Profil
            </div>

            <div class="spm-settings-tab 
                {{ $activeTab === 'user' ? 'active' : '' }}"
                wire:click="setTab('user')">
                <i class="la la-users"></i> Utilisateurs
            </div>

            <div class="spm-settings-tab 
                {{ $activeTab === 'plan' ? 'active' : '' }}"
                wire:click="setTab('plan')">
                <i class="las la-credit-card"></i> Plans
            </div>

            <div class="spm-settings-tab 
                {{ $activeTab === 'theme' ? 'active' : '' }}"
                wire:click="setTab('theme')">
                <i class="las la-palette"></i> Thèmes
            </div>

            <div class="spm-settings-tab 
                {{ $activeTab === 'product' ? 'active' : '' }}"
                wire:click="setTab('product')">
                <i class="las la-box"></i> Produit
            </div>

            <div class="spm-settings-tab 
                {{ $activeTab === 'role' ? 'active' : '' }}"
                wire:click="setTab('role')">
                <i class="las la-user-shield"></i> Rôle
            </div>

        </div>

        <!-- CONTENT -->
        <div class="spm-settings-content">
            @if($activeTab === 'Profil')
                <div class="spm-settings-panel">
                    @livewire('profile')
                </div>
            @endif

            @if($activeTab === 'user')
                <div class="spm-settings-panel">
                    @livewire('users')
                </div>
            @endif

            @if($activeTab === 'plan')
                <div class="spm-settings-panel">
                    @livewire('plans')
                </div>
            @endif

            @if($activeTab === 'theme')
                <div class="spm-settings-panel">
                    @livewire('themes')
                </div>
            @endif

            @if($activeTab === 'product')
                <div class="spm-settings-panel">
                    @livewire('products')
                </div>
            @endif

            @if($activeTab === 'role')
                <div class="spm-settings-panel">
                    @livewire('roles')
                </div>
            @endif
        </div>

    </div>
</div>