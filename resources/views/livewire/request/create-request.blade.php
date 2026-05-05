<div class="app-container-element">
    <form wire:submit.prevent="save">

        <x-form.textarea
            label="Description de la demande"
            wire:model="description"
            placeholder="Décrivez votre demande..."
        />

        <div class="app-form-group">
            <label>Fichiers</label>
            <input type="file" wire:model="files" multiple class="app-form-control">

            @error('files.*')
                <span class="app-error-text">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary">
            <i class="las la-save"></i>
            Envoyer la demande
        </button>
    </form>
</div>