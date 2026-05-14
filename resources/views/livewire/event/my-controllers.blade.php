<div class="app-container-element">

    <h2>
        <i class="las la-user-shield"></i>
        Mes contrôleurs
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

            <div class="form-card">

                <div class="form-info">

                    <div>
                        <b>Nom:</b>
                        {{ $user->name }}
                    </div>

                    <div>
                        <b>Email:</b>
                        {{ $user->email }}
                    </div>

                    @if($user->phone)
                        <div>
                            <b>Téléphone:</b>
                            {{ $user->phone }}
                        </div>
                    @endif

                </div>

            </div>

        @empty

            <p style="text-align:center;">
                Aucun contrôleur trouvé
            </p>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$users" />
    </div>

</div>