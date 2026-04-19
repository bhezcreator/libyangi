<div class="app-container-element">

    <h2><i class="las la-credit-card"></i> Plans</h2>

    <!-- HEADER -->
    <div class="forms-header">
        <input type="text" wire:model.live="search" placeholder="Rechercher..." class="forms-search">

        <button wire:click="create" class="btn btn-primary">
            <i class="las la-plus"></i> Plan
        </button>
    </div>

    <!-- LIST -->
    <div class="forms-list">
        @forelse($plans as $plan)
            <div class="form-card">

                <div class="form-info">
                    <div><b>Nom:</b> {{ $plan->name }}</div>
                    <div><b>Prix:</b> {{ $plan->price }} $</div>
                    <div><b>Invités max:</b> {{ $plan->max_guests }}</div>

                    <div>
                        <b>Fonctionnalités: {{ count($plan->features) }}</b>
                        <ul>
                            @foreach($plan->features ?? [] as $feature)
                                <li> <i class="la la-arrow-right"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="form-actions">

                    <button wire:click="edit({{ $plan->id }})" class="btn btn-info">
                        <i class="las la-edit"></i>
                    </button>

                    <button wire:click="confirmDelete({{ $plan->id }})" class="btn btn-danger">
                        <i class="las la-trash"></i>
                    </button>

                </div>

            </div>
        @empty
            <p style="text-align:center;">Aucun plan trouvé</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$plans" />
    </div>


    <!-- MODAL -->
    <x-centered-modal title="{{ $isEdit ? 'Modifier' : 'Ajouter' }} Plan" width="50%">

        <form wire:submit.prevent="save">

            <x-form.input label="Nom" wire:model="name" placeholder="Nom" />
            <x-form.input label="Prix" type="number" wire:model="price" placeholder="Prix" />
            <x-form.input label="Nombre max invités" type="number" wire:model="max_guests" placeholder="Nombre d'invités" />

            <x-form.textarea
                label="Fonctionnalités (séparés par virgule)"
                wire:model="features"
            />

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
        message="Supprimer ce plan ?" />

</div>