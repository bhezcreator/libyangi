<div class="events-present-container">

    <!-- Header -->
    <div class="events-present-header">
        <input type="text"
               wire:model.live="search"
               placeholder="Rechercher un événement..."
               class="events-present-search">

        <a href="{{ route('events.add') }}" class="events-present-add-btn">
            <i class="las la-plus"></i> Ajouter
        </a>
    </div>

    <!-- Grid -->
    <div class="events-present-grid">

        @forelse($events as $event)
            <div class="events-present-card">

                <div class="events-present-body">
                    <span class="events-present-type">{{ $event->type }}</span>

                    <h3>{{ $event->title }}</h3>

                    <p class="events-present-dates">
                        <i class="las la-calendar"></i>
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                    </p>

                    <p class="events-present-organizer">
                        <i class="las la-user"></i>
                        Organisateur : {{ $event->user_id }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="events-present-actions">
                    <a href="{{ route('events.show', $event->id) }}">
                        <i class="las la-eye"></i>
                    </a>

                    <a href="{{ route('events.edit', $event->id) }}">
                        <i class="las la-edit"></i>
                    </a>

                    <button wire:click="delete({{ $event->id }})">
                        <i class="las la-trash"></i>
                    </button>
                </div>

            </div>
        @empty
            <p class="events-present-empty">Aucun événement trouvé</p>
        @endforelse

    </div>

    <!-- Pagination -->
    <div class="events-present-pagination">
        {{ $events->links() }}
    </div>

</div>