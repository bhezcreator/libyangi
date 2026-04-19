<div class="profil-container">

    <!-- MESSAGE -->
    @if (session()->has('success'))
        <div class="profil-alert success">
            <i class="las la-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('success_password'))
        <div class="profil-alert success">
            <i class="las la-check-circle"></i>
            {{ session('success_password') }}
        </div>
    @endif

    <div class="profil-grid">

        <!-- PROFIL -->
        <div class="profil-card">
            <h2>
                Mon Profil
            </h2>

            <form wire:submit.prevent="updateProfile">

                <div class="profil-group">
                    <label>
                        <i class="las la-user"></i> Nom
                    </label>
                    <input type="text" wire:model="name">
                    @error('name') <span class="profil-error">{{ $message }}</span> @enderror
                </div>

                <div class="profil-group">
                    <label>
                        <i class="las la-envelope"></i> Email
                    </label>
                    <input type="email" wire:model="email">
                    @error('email') <span class="profil-error">{{ $message }}</span> @enderror
                </div>

                <button class="profil-btn">
                    <i class="las la-save"></i> Mettre à jour
                </button>

            </form>
        </div>

        <!-- MOT DE PASSE -->
        <div class="profil-card">
            <h2>
                Changer mot de passe
            </h2>

            <form wire:submit.prevent="updatePassword">

                <div class="profil-group">
                    <label>
                        <i class="las la-key"></i> Mot de passe actuel
                    </label>
                    <input type="password" wire:model="current_password">
                    @error('current_password') <span class="profil-error">{{ $message }}</span> @enderror
                </div>

                <div class="profil-group">
                    <label>
                        <i class="las la-lock"></i> Nouveau mot de passe
                    </label>
                    <input type="password" wire:model="new_password">
                    @error('new_password') <span class="profil-error">{{ $message }}</span> @enderror
                </div>

                <div class="profil-group">
                    <label>
                        <i class="las la-check-double"></i> Confirmer mot de passe
                    </label>
                    <input type="password" wire:model="new_password_confirmation">
                </div>

                <button class="profil-btn danger btn-danger">
                    <i class="las la-sync-alt"></i> Changer mot de passe
                </button>

            </form>
        </div>

    </div>

</div>