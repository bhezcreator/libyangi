<div>
    <div class="photo-event">

        <!-- HEADER -->
        <div class="photo-event__header">

            <div class="photo-event__header-content">

                <div>
                    <h2 class="photo-event__title">
                        Médias
                    </h2>
                </div>

                <div class="photo-event__actions">
                    <select type="text"
                        class="photo-event__search"
                        wire:model.live="search">
                        <option>-- Type --</option>
                        <option value="image">Image</option>
                        <option value="video">Vidéo</option>
                    </select>
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

                                <a href="{{ route('events.show.download', $media->id) }}" class="photo-event__icon-btn photo-event__icon-btn--edit">
                                    <i class="las la-download"></i>
                                </a>

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

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>