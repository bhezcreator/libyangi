<div class="app-container-element">

    <h2><i class="las la-credit-card"></i> Programmes</h2>

    <!-- HEADER -->
    <div class="forms-header">
        <input type="text" wire:model.live="search" placeholder="Rechercher..." class="forms-search">

        <button wire:click="create" class="btn btn-primary">
            <i class="las la-plus"></i> Programme
        </button>
    </div>

    <!-- LIST -->
    <div class="forms-list">
        @forelse($programmes as $pro)
            <div class="form-card">

                <div class="form-info">
                    @if ($pro->icone)
                        <div>
                            <i class="las {{ $pro->icone }}"></i>
                        </div>
                    @endif
                    <div><b>Titre :</b> {{ $pro->titre }}</div>
                    <div><b>Type : </b> {{ $pro->type }}</div>
                    <div><b>Ordre : </b> {{ $pro->order }}</div>
                    <div><b>Date & heure :</b> {{ \Carbon\Carbon::parse($pro->date_heure)->format('d/m/Y H:i') }}</div>
                </div>

                <div class="form-actions">

                    <button wire:click="edit({{ $pro->id }})" class="btn btn-secondary">
                        <i class="las la-edit"></i>
                    </button>

                    <button wire:click="confirmDelete({{ $pro->id }})" class="btn btn-danger">
                        <i class="las la-trash"></i>
                    </button>

                </div>
            </div>
        @empty
            <p style="text-align:center;">Aucun programme trouvé</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$programmes" />
    </div>

    <!-- MODAL -->
    <x-centered-modal title="{{ $isEdit ? 'Modifier' : 'Ajouter' }} Programme" width="50%">

        <form wire:submit.prevent="save">

            <x-form.input label="Titre" wire:model="titre" placeholder="Titre..." />
            <x-form.textarea label="Détail" wire:model="detail" placeholder="Description..." />
            <x-form.select
            label="Type"
            wire:model="type"
            :options="[
                'Programme'=>'Programme',
                'Détails'=>'Détails',
                ]"
            />
            <x-form.input label="Icône" wire:model="icone" placeholder="las-list" />
            <x-form.input type="datetime-local" label="Date & heure" wire:model="date_heure" />
            <x-form.input type="number" label="Ordre" wire:model="order" />

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
    <x-confirm-modal wire:model="confirmingDelete"
        title="Suppression"
        message="Supprimer ce programme ?" />

</div>