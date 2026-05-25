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
                    <i class="las la-user"></i>
                    {{ $event->user->name ?? '-' }}
                </div>

                <div>
                    <i class="las la-envelope"></i>
                    {{ $event->user->email ?? '-' }}
                </div>
            </div>

        </div>

        <div class="detail-vue-event-card">
            <h2 class="detail-vue-event-section-title">
                Concerne
            </h2>

            <div class="detail-vue-event-badge">
                {{ $event->concerne ?? '-' }}
            </div>
        </div>

        {{-- ADRESSES --}}
        <div class="detail-vue-event-card">
            <h2 class="detail-vue-event-section-title">
                Adresses
            </h2>

            @forelse($event->addresses as $address)
                <div class="detail-vue-event-badge">
                    {{ $address->address ?? '-' }}
                </div>
            @empty
                <p>Aucune adresse</p>
            @endforelse
        </div>

        {{-- INVITES --}}
        <div class="detail-vue-event-card">

            <h2 class="detail-vue-event-section-title">
                Invité(s)
            </h2>

            <div class="detail-vue-event-badge">
                {{ $event->guests->count() }} invité(s)
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
                    <i class="las la-share-alt"></i> Actions & Partages
                </h2>

                {{-- VOIR --}}
                <a
                    href="{{ route('events.show', [$event->slug, bin2hex($event->id)]) }}"
                    target="_blank"
                    class="detail-vue-event-btn">
                    <i class="las la-external-link-alt"></i>
                    Voir l’invitation
                </a>
                
                {{-- WHATSAPP --}}
                <a
                    class="detail-vue-event-btn" id="share-whatsapp">
                    <i class="lab la-whatsapp"></i>
                    Partager WhatsApp
                </a>

                @php
                    $lien = route('events.show', [$event->slug, bin2hex($event->id)]);

                    $subject = rawurlencode('Tu es invité(e) !');
                    $body = rawurlencode(
                        "Bonjour,\r\n\r\n".
                        "Voici ton invitation :\r\n".
                        $lien
                    );
                @endphp

                <a
                    href="mailto:?subject={{ $subject }}&body={{ $body }}"
                    class="detail-vue-event-btn">

                    <i class="las la-envelope"></i>
                    Partager Email
                </a>

                {{-- FACEBOOK --}}
                <a
                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('events.show', [$event->slug, bin2hex($event->id)])) }}"
                    target="_blank"
                    class="detail-vue-event-btn">
                    <i class="lab la-facebook-f"></i>
                    Partager Facebook
                </a>

                {{-- QR CODE --}}
                <a
                    href="{{ route('events.qr', [bin2hex(route('events.show', [$event->slug, $event->id]))]) }}"
                    class="detail-vue-event-btn">
                    <i class="las la-qrcode"></i>
                    Générer QR Code
                </a>

            </div>

        </div>

    </div>

    <script>
        document.getElementById('share-whatsapp').addEventListener('click', function () {
            const message = encodeURIComponent("*{{ $event->title }}*\n\n  _Veuillez cliquer sur le lien ci-dessous pour visualiser, réagir et télécharger celle-ci(ou celui-ci)._ \n\n👉 {{ route('events.show', [$event->slug, bin2hex($event->id)]) }}");
            const whatsappUrl = `https://wa.me/?text=${message}`;
            window.open(whatsappUrl, '_blank');
        });
    </script>
</div>