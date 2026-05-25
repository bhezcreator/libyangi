{{-- <div class="events-present-container">

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
                        Organisateur : {{ $event->user->name }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="events-present-actions">
                    <a href="{{ route('events.detail', $event->id) }}">
                        <i class="las la-eye"></i>
                    </a>

                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('events.edit', ['subscription_id' => $event->subscription_id, 'user_id' => $event->user_id, 'event' => $event->id ]) }}">
                            <i class="las la-edit"></i>
                        </a>    

                        <button wire:click="confirmDelete({{ $event->id }})" >
                            <i class="las la-trash"></i>
                        </button>
                    @endif
                </div>

            </div>
        @empty
            <p class="events-present-empty">Aucun événement trouvé</p>
        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$events" />
    </div>

        <!-- DELETE MODAL -->
    <x-confirm-modal wire:model="confirmingDelete"
        title="Suppression"
        message="Voulez-vous supprimer cet événement ?" />
</div> --}}

<div class="evt-wrapper">

    {{-- FILTER BAR --}}
    <div class="evt-filter-card">

        <div class="evt-filter-grid">

            {{-- SEARCH --}}
            <div class="evt-search-box">

                <i class="las la-search evt-search-icon"></i>

                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Rechercher un événement..."
                    class="evt-search-input"
                >
            </div>

            {{-- TYPE --}}
            <select wire:model.live="type" class="evt-select">

                <option value="">
                    Toutes les catégories
                </option>

                @foreach ($types as $item)
                    <option value="{{ $item }}">
                        {{ ucfirst($item) }}
                    </option>
                @endforeach

            </select>

            {{-- STATUS --}}
            <select wire:model.live="status" class="evt-select">
                <option value="">
                    Tous les statuts
                </option>

                <option value="publié">
                    Publié
                </option>

                <option value="brouillon">
                    Brouillon
                </option>

                <option value="annulé">
                    Annulé
                </option>
            </select>

            {{-- RESET --}}
            <button wire:click="resetFilters" class="evt-reset-btn">
                <i class="las la-sync-alt"></i>
            </button>

            {{-- ADD --}}
            <a href="{{ route('events.add') }}" class="evt-add-btn">
                <i class="las la-plus"></i>
            </a>
        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="evt-table-card">
        <div class="evt-table-responsive">
            <table class="evt-table">
                <thead>
                    <tr>
                        <th>ÉVÉNEMENT</th>
                        <th>CATÉGORIE</th>
                        <th>DATE</th>
                        <th>LIEU</th>
                        <th>STATUT</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            {{-- EVENT --}}
                            <td>
                                <div class="evt-event-info">
                                    <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/logo libyangi mobile transp.png') }}" class="evt-event-image">

                                    <div>
                                        <h4>
                                            {{ $event->title }}
                                        </h4>

                                        <span>
                                            {{ $event->guests->count() }} participants
                                        </span>
                                    </div>
                                </div>

                            </td>

                            {{-- CATEGORY --}}
                            <td>
                                <span class="evt-badge evt-badge-purple">
                                    {{ ucfirst($event->type) }}
                                </span>
                            </td>

                            {{-- DATE --}}
                            <td>
                                <div class="evt-date">
                                    <strong>
                                        {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d M Y') }}
                                    </strong>

                                    <span>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($event->end_date)->format('H:i') }}
                                    </span>
                                </div>
                            </td>

                            {{-- LOCATION --}}
                            <td>
                                <div class="evt-location">
                                    @if ($event->addresses->first())
                                        {{ $event->addresses->first()->address ?? '-' }}
                                    @else
                                        Adresse indisponible
                                    @endif
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                <span class="evt-status
                                    @if($event->status == 'publié')
                                        evt-status-green
                                    @elseif($event->status == 'brouillon')
                                        evt-status-orange
                                    @else
                                        evt-status-red
                                    @endif ">

                                    <i class="las la-circle"></i>
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <div class="evt-actions">

                                    {{-- VIEW --}}
                                    <a href="{{ route('events.detail', $event->id) }}" class="evt-action-btn evt-view-btn">
                                        <i class="las la-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('events.edit', ['subscription_id' => $event->subscription_id, 'user_id' => $event->user_id, 'event' => $event->id ]) }}"
                                        class="evt-action-btn evt-edit-btn">
                                        <i class="las la-edit"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    <button wire:click="confirmDelete({{ $event->id }})" class="evt-action-btn evt-delete-btn">
                                        <i class="las la-trash"></i>
                                    </button>

                                </div>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td>
                                <div class="evt-empty">
                                    <i class="las la-calendar-times"></i>
                                    <p>
                                        Aucun événement trouvé.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                    

                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="forms-pagination">
            <x-pagination :paginator="$events" />
        </div>

        <!-- DELETE MODAL -->
        <x-confirm-modal wire:model="confirmingDelete" title="Suppression" message="Voulez-vous supprimer cet événement ?" /> 
    </div>
</div>