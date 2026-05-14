<div>
    <div class="photo-event">

        <!-- HEADER -->
        <div class="photo-event__header">

            <div class="photo-event__header-content">

                <div>
                    <h2 class="photo-event__title">
                        Gestion des médias
                    </h2>

                    <p class="photo-event__subtitle">
                        Gérez les photos et médias de l'événement
                    </p>
                </div>

                <div class="photo-event__actions">

                    <input
                        type="text"
                        class="photo-event__search"
                        placeholder="Recherche..."
                        wire:model.live="search"
                    >

                    <button
                        type="button"
                        class="photo-event__add-btn"
                        wire:click="create"
                    >
                        <i class="las la-plus"></i>

                        <span>
                            Ajouter
                        </span>
                    </button>

                </div>

            </div>

        </div>

        <!-- BODY -->
        <div class="photo-event__body">

            <div class="photo-event__grid" wire:loading.class="photo-event__loading">

                @forelse($medias as $media)

                    <div class="photo-event__item">
                        <!-- IMAGE -->
                        <div class="photo-event__image-wrapper"> 
                        
                            @php
                                $file = $media->files->first();

                                $mediaUrl = $file
                                    ? asset('storage/' . $file->id . '/' . $file->file_name)
                                    : null;
                            @endphp

                            @if($media->type === 'video')

                                <video controls class="photo-event__image">

                                    <source src="{{ $mediaUrl }}">

                                </video>

                            @else

                                <img
                                    src="{{ $mediaUrl }}"
                                    class="photo-event__image"
                                    alt="media"
                                    loading="lazy"
                                >

                            @endif

                            <div class="photo-event__overlay">

                                <button
                                    type="button"
                                    class="photo-event__icon-btn photo-event__icon-btn--edit"
                                    wire:click="edit({{ $media->id }})"
                                >
                                    <i class="las la-edit"></i>
                                </button>

                                <button
                                    type="button"
                                    class="photo-event__icon-btn photo-event__icon-btn--delete"
                                    wire:click="confirmDelete({{ $media->id }})"
                                >
                                    <i class="las la-trash"></i>
                                </button>

                            </div>

                        </div>

                        <!-- CONTENT -->
                        <div class="photo-event__content">

                            <div class="photo-event__badges">

                                <span class="photo-event__badge photo-event__badge--primary">
                                    {{ $media->type }}
                                </span>

                                <span class="photo-event__badge photo-event__badge--secondary">
                                    {{ $media->visibility }}
                                </span>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="photo-event__empty">

                        <div class="photo-event__empty-icon">
                            <i class="las la-image"></i>
                        </div>

                        <h3 class="photo-event__empty-title">
                            Aucun média trouvé
                        </h3>

                        <p class="photo-event__empty-text">
                            Ajoutez des photos ou vidéos pour cet événement.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination mt-3">
        <x-pagination :paginator="$medias" />
    </div>

    <!-- MODAL -->
    <x-centered-modal title="{{ $isEdit ? 'Modifier' : 'Ajouter' }} Média" width="50%">

        <form wire:submit.prevent="save">
            <div class="app-form-group">

                <label class="form-label">
                    Média
                </label>
                <input type="file" multiple class="app-form-control" wire:model="files" accept="image/*,video/*" >

                @error('files.*')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

                <!-- LOADING -->
                <div class="photo-event__upload-loading" wire:loading wire:target="files">
                    <div class="photo-event__loader"></div>
                    <span>
                        Téléversement des fichiers...
                    </span>
                </div>

                <!-- PREVIEW -->
                @if(!empty($files))

                    <div class="photo-event__preview-grid">

                        @foreach(collect($files)->filter() as $item)

                            @if(is_object($item) && method_exists($item, 'temporaryUrl'))

                                @php
                                    $mime = $item->getMimeType();
                                @endphp

                                <div class="photo-event__preview-item">

                                    @if(str_contains($mime, 'video'))

                                        <video controls class="photo-event__preview-media">
                                            <source src="{{ $item->temporaryUrl() }}">
                                        </video>

                                    @elseif(str_contains($mime, 'image'))

                                        <img
                                            src="{{ $item->temporaryUrl() }}"
                                            class="photo-event__preview-media"
                                        >

                                    @endif

                                </div>

                            @endif

                        @endforeach

                    </div>

                @endif
            </div>

            <div class="app-form-group">
                <label class="app-toggle">
                    <input type="checkbox" wire:model.live="isPrivate">

                    <span class="slider"></span>

                    <span class="text">
                        Accès : {{ $isPrivate ? 'Restreint' : 'Tout le monde' }}
                    </span>
                </label>
            </div>

            <button class="btn btn-primary">
                <i class="las la-save"></i>{{ $isEdit ? 'Modifier' : 'Enregistrer' }}
            </button>
        </form>

        <x-slot name="footer">
            <button @click="$wire.showModalInterne = false" class="btn btn-danger">Fermer</button>
        </x-slot>
    </x-centered-modal>

    <!-- DELETE MODAL -->
    <x-confirm-modal wire:model="confirmingDelete" title="Suppression" message="Supprimer ce média ?" />

</div>