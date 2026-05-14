<div class="app-container-element">
    <form wire:submit.prevent="save">

        <x-form.textarea
            label="Description de la demande"
            wire:model="description"
            placeholder="Décrivez votre demande..."
        />

        <!-- UPLOAD -->
        <div class="app-form-group">
            <label>Fichiers</label>
            <input type="file" wire:model="files" multiple class="app-form-control">

            @error('files.*')
                <span class="app-error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- LISTE DES FICHIERS -->
        @if($files)
            <div class="demande-add-files">
                <div class="demande-add-title">
                    <i class="las la-paperclip"></i>
                    Fichiers sélectionnés
                </div>

                <ul class="demande-add-file-list">
                    @forelse($files as $index => $file)
                        <li class="demande-add-file-item">

                            <div class="demande-add-file-info">
                                <i class="las la-file demande-add-file-icon"></i>
                                {{ $file->getClientOriginalName() }}
                            </div>

                            <button 
                                type="button"
                                class="demande-add-delete-btn"
                                wire:click="removeFile({{ $index }})"
                            >
                                <i class="las la-trash"></i>
                            </button>

                        </li>
                    @empty
                        <div class="demande-add-empty">
                            Aucun fichier sélectionné
                        </div>
                    @endforelse
                </ul>
            </div>
        @endif

        <!-- ACTIONS -->
        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-primary">
                <i class="las la-save"></i>
                Envoyer la demande
            </button>

            <button 
                type="button"
                class="btn btn-danger"
                wire:click="cancel"
            >
                <i class="las la-times"></i>
                Annuler
            </button>
        </div>

    </form>
</div>