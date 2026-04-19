<div class="app-container-element">

    <h2><i class="las la-box"></i> Produits</h2>

    <!-- HEADER -->
    <div class="forms-header">
        <input type="text" wire:model.live="search" placeholder="Rechercher..." class="forms-search">

        <button wire:click="create" class="btn btn-primary">
            <i class="las la-plus"></i> Produit
        </button>
    </div>

    <!-- LIST -->
    <div class="forms-list">
        @forelse($products as $product)
            <div class="form-card">

                <div class="form-info">
                    <div><b>Nom:</b> {{ $product->name }}</div>
                    <div><b>Catégorie:</b> {{ $product->category }}</div>

                    <div>
                        <b>Événements liés:</b> {{ $product->events->count() }}
                    </div>
                </div>

                <div class="form-actions">

                    <button wire:click="edit({{ $product->id }})" class="btn btn-info">
                        <i class="las la-edit"></i>
                    </button>

                    <button wire:click="confirmDelete({{ $product->id }})" class="btn btn-danger">
                        <i class="las la-trash"></i>
                    </button>

                </div>

            </div>
        @empty
            <p style="text-align:center;">Aucun produit trouvé</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$products" />
    </div>

    <!-- MODAL -->
    <x-centered-modal title="{{ $isEdit ? 'Modifier' : 'Ajouter' }} Produit" width="50%">

        <form wire:submit.prevent="save">
            <x-form.input label="Nom" wire:model="name" placeholder="Nom du produit" />
            <x-form.select
                label="Catégorie"
                wire:model="category"
                :options="[
                    'Boissons sucré' => 'Boissons sucré',
                    'Boissons alcolique' => 'Boissons alcolique',
                    'Aliments' => 'Aliments',
                    'Plans' => 'Plans'
                ]"
                placeholder="-- Sélectionner la catégorie --"
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
        message="Supprimer ce produit ?" />

</div>