<div class="detail-vue-event-wrapper">

    {{-- COLONNE DETAILS --}}
    <div class="detail-vue-event-left">

        {{-- IMAGE --}}
        <div class="detail-vue-event-card">

            @if($event->image)
                <img
                    src="{{ asset('storage/'.$event->image) }}"
                    class="detail-vue-event-image"
                    alt="{{ $event->title }}">
            @endif

            <div class="detail-vue-event-content">

                <div class="detail-vue-event-status">
                    {{ $event->status }}
                </div>

                <h1 class="detail-vue-event-title">
                    {{ $event->title }}
                </h1>

                <div class="detail-vue-event-meta">

                    <div>
                        <strong>Type :</strong>
                        {{ $event->type }}
                    </div>

                    <div>
                        <strong>Début :</strong>
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                    </div>

                    <div>
                        <strong>Fin :</strong>
                        {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                    </div>

                    <div>
                        <strong>Slug :</strong>
                        {{ $event->slug }}
                    </div>

                </div>

                <div class="detail-vue-event-section">
                    <h3>Description</h3>

                    <div class="detail-vue-event-description">
                        {!! $event->description !!}
                    </div>
                </div>

            </div>
        </div>

        {{-- THEME --}}
        @if (auth()->user()->hasRole('admin'))
            <div class="detail-vue-event-card">
                <h2 class="detail-vue-event-section-title">
                    Theme
                </h2>

                @if($event->theme)
                    {{-- <div class="detail-vue-event-theme"> --}}
                    <div class="detail-vue-event-badge">
                        {{ $event->theme->title }}
                    </div>
                @endif
            </div>
        @endif

        {{-- ORGANISATEUR --}}
        <div class="detail-vue-event-card">

            <h2 class="detail-vue-event-section-title">
                Organisateur
            </h2>

            <div class="detail-vue-event-grid">

                <div>
                    <strong>Nom :</strong>
                    {{ $event->user->name ?? '-' }}
                </div>

                <div>
                    <strong>Email :</strong>
                    {{ $event->user->email ?? '-' }}
                </div>

            </div>

        </div>

        {{-- ADRESSES --}}
        <div class="detail-vue-event-card">

            <h2 class="detail-vue-event-section-title">
                Adresses
            </h2>

            @forelse($event->addresses as $address)

                <div class="detail-vue-event-address">

                    <div>
                        <strong>Adresse :</strong>
                        {{ $address->address ?? '-' }}
                    </div>

                    <div>
                        <strong>Latitude :</strong>
                        {{ $address->latitude ?? '-' }}
                    </div>

                    <div>
                        <strong>Longitude :</strong>
                        {{ $address->longitude ?? '-' }}
                    </div>

                </div>

            @empty

                <p>Aucune adresse</p>

            @endforelse

        </div>

        {{-- INVITES --}}
        <div class="detail-vue-event-card">

            <h2 class="detail-vue-event-section-title">
                Invités
            </h2>

            <div class="detail-vue-event-badge">
                {{ $event->guests->count() }} invités
            </div>

        </div>

        {{-- PRODUITS --}}
        <div class="detail-vue-event-card">

            <h2 class="detail-vue-event-section-title">
                Produits
            </h2>

            <div class="detail-vue-event-products">

                @forelse($event->products as $product)

                    <div class="detail-vue-event-product">
                        {{ $product->name }}
                    </div>

                @empty

                    <p>Aucun produit</p>

                @endforelse

            </div>

        </div>

    </div>

    {{-- COLONNE ACTIONS --}}
    <div class="detail-vue-event-right">

        <div class="detail-vue-event-sticky">

            <div class="detail-vue-event-share-card">

                <h2 class="detail-vue-event-share-title">
                    Actions & Partages
                </h2>

                {{-- VOIR --}}
                <a
                    href="{{ route('events.show', $event->slug) }}"
                    target="_blank"
                    class="detail-vue-event-btn">

                    Voir Externe

                </a>

                {{-- WHATSAPP --}}
                <a
                    href="https://wa.me/?text={{ urlencode(route('events.show', $event->slug)) }}"
                    target="_blank"
                    class="detail-vue-event-btn">

                    Partager WhatsApp

                </a>

                {{-- EMAIL --}}
                <a
                    href="mailto:?subject={{ $event->title }}&body={{ route('events.show', $event->slug) }}"
                    class="detail-vue-event-btn">

                    Partager Email

                </a>

                {{-- FACEBOOK --}}
                <a
                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('events.show', $event->slug)) }}"
                    target="_blank"
                    class="detail-vue-event-btn">

                    Partager Facebook

                </a>

                {{-- QR CODE --}}
                <a
                    href="{{ route('events.qr', $event->id) }}"
                    target="_blank"
                    class="detail-vue-event-btn">

                    Générer QR Code
                </a>

            </div>

        </div>

    </div>

</div>