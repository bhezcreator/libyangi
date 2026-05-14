<div class="app-container-element">

    <h2>
        <i class="las la-user-shield"></i>
        Contrôleurs de l'événement
    </h2>

    <!-- HEADER -->
    <div class="forms-header">

        <input
            type="text"
            wire:model.live="search"
            placeholder="Rechercher..."
            class="forms-search"
        >

    </div>

    <!-- LIST -->
    <div class="forms-list">

        @forelse($users as $user)

            @php
                $isController = $this->isController($user->id);
            @endphp

            <div class="form-card">

                <div class="form-info">

                    <div>
                        <b>Nom:</b> {{ $user->name }}
                    </div>

                    <div>
                        <b>Email:</b> {{ $user->email }}
                    </div>

                </div>

                <div class="form-actions">

                    @if($isController)

                        <button
                            wire:click="toggleController({{ $user->id }})"
                            class="btn btn-danger"
                        >
                            <i class="las la-user-minus"></i>
                            Retirer
                        </button>

                    @else

                        <button
                            wire:click="toggleController({{ $user->id }})"
                            class="btn btn-success"
                        >
                            <i class="las la-user-plus"></i>
                            Attribuer
                        </button>

                    @endif

                </div>

            </div>

        @empty

            <p style="text-align:center;">
                Aucun utilisateur trouvé
            </p>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$users" />
    </div>

</div>