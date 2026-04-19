<div class="app-container-element">

    <h2><i class="las la-palette"></i> Thèmes</h2>

    <!-- HEADER -->
    <div class="forms-header">
        <input type="text" wire:model.live="search" placeholder="Rechercher..." class="forms-search">

        <button wire:click="create" class="btn btn-primary">
            <i class="las la-plus"></i> Thème
        </button>
    </div>

    <!-- LIST -->
    <div class="forms-list">
        @forelse($themes as $theme)
            <div class="form-card">

                <div class="form-info">
                    <div><b>Titre:</b> {{ $theme->title }}</div>

                    <div>
                        <b>Couleurs:</b>
                        <span style="background: {{ $theme->page_bg_color }};"> Page </span>
                        <span style="background: {{ $theme->message_bg_color }};"> Message </span>
                    </div>

                    <div><b>Style bordure:</b> {{ $theme->border_style }}</div>

                    @if($theme->message_image)
                        <img src="{{ asset('storage/'.$theme->message_image) }}" width="80">
                    @endif
                </div>

                <div class="form-actions">
                    <a href="{{ route('themes.preview', $theme->id) }}" target="_blank" class="btn btn-success">
                        <i class="las la-eye"></i>
                    </a>

                    <button wire:click="edit({{ $theme->id }})" class="btn btn-info">
                        <i class="las la-edit"></i>
                    </button>

                    <button wire:click="confirmDelete({{ $theme->id }})" class="btn btn-danger">
                        <i class="las la-trash"></i>
                    </button>
                </div>

            </div>
        @empty
            <p style="text-align:center;">Aucun thème trouvé</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$themes" />
    </div>

    <!-- MODAL -->
    <x-centered-modal title="{{ $isEdit ? 'Modifier' : 'Ajouter' }} Thème" width="50%">

        <form wire:submit.prevent="save">
            <x-form.input label="Titre thème" type="text" wire:model="title" placeholder='Titre thème' />
            <x-form.input label="Couleur titre" type="color" wire:model="title_color" />
            <x-form.input label="Couleur message" type="color" wire:model="message_color" />
            <x-form.input label="Couleur fond message" type="color" wire:model="message_bg_color" />
            <x-form.input label="Couleur fond page" type="color" wire:model="page_bg_color" />
            <x-form.input label="Image message" type="file" wire:model="message_image" />

           <x-form.select 
                label="Type de contour"
                wire:model="border_style"
                :options="[
                    'Sans' => 'Sans',
                    'Simple' => 'Simple',
                    'Double' => 'Double',
                    'Pointiller' => 'Pointiller'
                ]"
                placeholder="-- Indiquer le type de contour --"
            />

            <button class="btn btn-primary">
                {{ $isEdit ? 'Modifier' : 'Enregistrer' }}
            </button>
        </form>

        <x-slot name="footer">
            <button @click="$wire.showModalInterne = false" class="btn btn-danger">Fermer</button>
        </x-slot>

    </x-centered-modal>

    <!-- DELETE -->
    <x-confirm-modal wire:model="confirmingDelete"
        title="Suppression"
        message="Supprimer ce thème ?" />

</div>