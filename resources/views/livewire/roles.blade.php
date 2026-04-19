<div class="app-container-element">

    <h2><i class="las la-user-shield"></i> Rôles</h2>

    <!-- HEADER -->
    <div class="forms-header">
        <input type="text" wire:model.live="search" placeholder="Rechercher..." class="forms-search">

        <button wire:click="create" class="btn btn-primary">
            <i class="las la-plus"></i> Rôle
        </button>
    </div>

    <!-- LIST -->
    <div class="forms-list">
        @forelse($roles as $role)
            <div class="form-card">

                <div class="form-info">
                    <div><b>Nom:</b> {{ $role->name }}</div>
                    <div><b>Garde:</b> {{ $role->guard_name }}</div>
                </div>

                <div class="form-actions">

                    <button wire:click="edit({{ $role->id }})" class="btn btn-info">
                        <i class="las la-edit"></i>
                    </button>

                    <button wire:click="confirmDelete({{ $role->id }})" class="btn btn-danger">
                        <i class="las la-trash"></i>
                    </button>

                </div>

            </div>
        @empty
            <p style="text-align:center;">Aucun rôle trouvé</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$roles" />
    </div>

    <!-- MODAL -->
    <x-centered-modal title="{{ $isEdit ? 'Modifier' : 'Ajouter' }} rôle" width="40%">

        <form wire:submit.prevent="save">

            <x-form.input label="Nom du rôle" wire:model="name" placeholder="ex: admin" />

            <x-form.input label="Nom du garde" wire:model="guard_name" />

            <button class="btn btn-primary">
                <i class="las la-save"></i>
                {{ $isEdit ? 'Modifier' : 'Enregistrer' }}
            </button>

        </form>

        <x-slot name="footer">
            <button @click="$wire.showModalInterne = false" class="btn btn-danger">Fermer</button>
        </x-slot>

    </x-centered-modal>

    <!-- DELETE MODAL -->
    <x-confirm-modal
        wire:model="confirmingDelete"
        title="Suppression"
        message="Supprimer ce rôle ?" />

</div>