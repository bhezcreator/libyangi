<div class="app-container-element">

    <h2><i class="las la-user"></i> Utilisateurs</h2>

    <!-- HEADER -->
    <div class="forms-header">
        <input type="text" wire:model.live="search" placeholder="Rechercher..." class="forms-search">

        <button wire:click="create" class="btn btn-primary">
            <i class="las la-plus"></i> Utilisateur
        </button>
    </div>

    <!-- LIST -->
    <div class="forms-list">
        @forelse($users as $user)
            <div class="form-card">

                <div class="form-info">
                    <div><b>Nom:</b> {{ $user->name }}</div>
                    <div><b>Email:</b> {{ $user->email }}</div>

                    <div>
                        <b>Rôles:</b>
                        @foreach($user->roles as $role)
                            <span>{{ $role->name }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="form-actions">

                    <button wire:click="edit({{ $user->id }})" class="btn btn-info">
                        <i class="las la-edit"></i>
                    </button>

                    <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-danger">
                        <i class="las la-trash"></i>
                    </button>

                </div>

            </div>
        @empty
            <p style="text-align:center;">Aucun utilisateur trouvé</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$users" />
    </div>

    <!-- MODAL -->
    <x-centered-modal title="{{ $isEdit ? 'Modifier' : 'Ajouter' }} utilisateur" width="50%">

        <form wire:submit.prevent="save">

            <x-form.input label="Nom" wire:model="name" />
            <x-form.input label="Email" wire:model="email" />
            <x-form.input label="Mot de passe" type="password" wire:model="password" />

            <!-- ROLES -->
            <div style="margin-bottom: 10px" class="app-form-group">
                <label>Rôles</label>

                <div  style="margin-top: &àpx">
                    @foreach($allRoles as $role)
                        <label style="margin: 10px;">
                            <input type="checkbox"
                                   wire:model="roles"
                                   value="{{ $role->name }}">
                            {{ $role->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-primary">
                <i class="las la-save"></i>
                {{ $isEdit ? 'Modifier' : 'Enregistrer' }}
            </button>

        </form>

        <x-slot name="footer">
            <button @click="$wire.showModalInterne = false" class="btn btn-danger">Fermer</button>
        </x-slot>

    </x-centered-modal>

    <!-- DELETE -->
    <x-confirm-modal
        wire:model="confirmingDelete"
        title="Suppression"
        message="Supprimer cet utilisateur ?" />

</div>