<div style="background: radial-gradient(circle at top right, rgba(124,58,237,.10), transparent 30%), #f8fafc;min-height: 100vh;height: auto;padding: 30px 0;overflow:hidden;display: flex;justify-content: center;align-items: start;">
    
    <link rel="stylesheet" href="{{ asset('styles/themes/invite-mar.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <!-- LOADING -->
    <div class="invitation-loader" id="loader" wire:ignore>

        <div class="animated-bg">
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>

            <div class="light-wave"></div>
        </div>

        <div class="loader-content">

            <p class="loader-onetitle">
                Invitation
            </p>

            <div class="pulse-ring">
                <div class="loader-circle">
                    <i class="las la-heart"></i>
                </div>
            </div>

            <h1 class="loader-title">
                {{ Str::limit($event->title, 30, '...') }}
            </h1>

            <p class="loader-subtitle">
                Veuillez patienter quelques instants
            </p>

            <div class="loading-dots">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>

    <!-- TOAST -->
    <div x-data="toastSystem()" x-on:toast.window="add($event.detail)" class="toast-container" >
        <template x-for="(toast, index) in toasts" :key="index">
                <div class="app-toast" x-show="toast.show" x-transition :style="'border-left:5px solid ' + toast.color">
                    <span class="app-toast-icon" x-transition :style="'color: ' + toast.color" x-text="toast.icon"></span>
                    <span class="app-toast-message" x-text="toast.message"></span>
                </div>
        </template>
    </div>

    @if ($event->end_date < date('Y-m-d'))
        <div class="msg-fin-event-container">
            <div class="msg-fin-event-card">

                <div class="msg-fin-event-icon">
                    <i class="las la-calendar-times"></i>
                </div>

                <div class="msg-fin-event-content">
                    <h2 class="msg-fin-event-title">
                        Événement terminé
                    </h2>

                    <p class="msg-fin-event-text">
                        Désolé, la date limite de cette invitation est déjà dépassée.
                        L'événement est maintenant terminé.
                    </p>

                    <a href="{{ route('events.show.picture',[$event->id]) }}" 
                        class="msg-fin-event-btn">
                        <i class="las la-image"></i>
                        Voir les photos
                    </a>

                    <a href="/" 
                        class="msg-fin-event-btn btn-retour">
                        Aller à la page d'accueil
                        <i class="las la-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="cadre-theme-event">
            {{-- TYPE FLOTTANT --}}
            <div class="type-event">
                <i class="las la-heart"></i>
                <span>{{ Str::limit($event->title, 60, '...') }}</span>
            </div>

            <div class="container-theme-event">
                {{-- HERO --}}

                <div class="pr-invit-li-wrapper">
                    
                    <div class="pr-invit-li-card">
                        <!-- Image -->
                        <div class="pr-invit-li-image">
                            <img src="{{ asset('storage/'.$event->image) }}" alt="Invitation">
                        </div>

                        <!-- Overlay -->
                        <div class="pr-invit-li-overlay">
                        
                            <div class="pr-invit-li-content">

                                {{-- <div class="pr-invit-li-icon">
                                    <i class="las la-heart"></i>
                                </div> --}}
                                <h4 class="pr-invit-li-title-event">
                                    {{ $event->title }}
                                </h4>

                                <h2 class="pr-invit-li-title">
                                    <span>{{ $event->concerne }}</span>
                                </h2>

                                <div class="pr-invit-li-date-box">

                                    <!-- Heure -->
                                    <div class="pr-invit-li-date-time">
                                        <span class="pr-invit-li-big">
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('H.i') }}
                                        </span>

                                        <span class="pr-invit-li-small">
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('A') }}
                                        </span>
                                    </div>

                                    <div class="pr-invit-li-divider"></div>

                                    <!-- Jour et mois -->
                                    <div class="pr-invit-li-date-center">

                                        <span class="pr-invit-li-day">
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}
                                        </span>

                                        <span class="pr-invit-li-month">
                                            {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('M') }}
                                        </span>

                                    </div>

                                    <div class="pr-invit-li-divider"></div>

                                    <!-- Année -->
                                    <div class="pr-invit-li-date-year">

                                        <span class="pr-invit-li-small">
                                            {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('D') }}
                                        </span>

                                        <span class="pr-invit-li-year">
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('Y') }}
                                        </span>

                                    </div>
                                    
                                </div>

                                <div class="pr-invit-li-text">
                                    {!! $event->description !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFOS --}}
                <div class="infos-theme-event">

                    <!-- Accordion -->
                    <form wire:submit.prevent="save" class="accordion-theme-event">

                        <div class="accordion-item">
                            <button class="accordion-header" wire:ignore>
                                <h6><i class="las la-map-marker title-icon"></i>Adresse</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                            </button>
                            <div class="accordion-body" wire:ignore>
                                
                                <div class="espace">
                                    <p class="espace-title">
                                        Veuillez consulter les informations d’accès et de localisation afin de préparer votre venue.
                                    </p>

                                    @forelse($event->addresses as $index => $adresseItem)
                                        @if(!is_null($adresseItem->latitude) && !is_null($adresseItem->longitude))
                                            <div class="mb-4">

                                                <p class="espace-title mb-2">
                                                    <i class="las la-map-marker title-icon"></i>
                                                    <strong>Adresse {{ $index+1 }} :</strong>
                                                    {{ $adresseItem->address }}
                                                </p>

                                                <div wire:ignore id="map-{{ $adresseItem->id }}" class="event-map"></div>

                                            </div>
                                        @endif
                                    @empty
                                        <p>Aucune adresse disponible pour cet événement.</p>
                                    @endforelse
                                </div>

                            </div>
                        </div>

                        <div class="accordion-item">
                            <button class="accordion-header" wire:ignore>
                                <h6><i class="las la-tasks title-icon"></i>Programme</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                            </button>
                            <div class="accordion-body" wire:ignore>
                                <div class="espace">
                                    <div class="prog-evt-wrapper">

                                        <div class="prog-evt-title">
                                            PROGRAMME 
                                        </div>

                                        <div class="prog-evt-timeline">

                                            @php
                                                $programmes = $event->programmes
                                                    ->where('type', 'Programme')
                                                    ->sortBy('order')
                                                    ->values();
                                            @endphp

                                            @forelse ($programmes as $index => $prog)

                                                <div class="prog-evt-item {{ $index % 2 == 0 ? 'prog-evt-left' : 'prog-evt-right' }}">

                                                    {{-- AFFICHAGE GAUCHE --}}
                                                    @if ($index % 2 == 0)

                                                        <div class="prog-evt-content">

                                                            @if ($prog->date_heure)
                                                                <h2>
                                                                    {{ \Carbon\Carbon::parse($prog->date_heure)->format('H:i') }}
                                                                </h2>
                                                            @endif

                                                            <div class="prog-evt-divider"></div>

                                                            <h3>{{ strtoupper($prog->titre) }}</h3>

                                                            @if ($prog->detail)
                                                                <p>
                                                                    {!! nl2br(e($prog->detail)) !!}
                                                                </p>
                                                            @endif

                                                        </div>

                                                        <div class="prog-evt-icon">
                                                            <i class="las {{ $prog->icone ?? 'la-calendar' }}"></i>
                                                        </div>

                                                    {{-- AFFICHAGE DROITE --}}
                                                    @else

                                                        <div class="prog-evt-icon">
                                                            <i class="las {{ $prog->icone ?? 'la-calendar' }}"></i>
                                                        </div>

                                                        <div class="prog-evt-content">

                                                            @if ($prog->date_heure)
                                                                <h2>
                                                                    {{ \Carbon\Carbon::parse($prog->date_heure)->format('H:i') }}
                                                                </h2>
                                                            @endif

                                                            <div class="prog-evt-divider"></div>

                                                            <h3>{{ strtoupper($prog->titre) }}</h3>

                                                            @if ($prog->detail)
                                                                <p>
                                                                    {!! nl2br(e($prog->detail)) !!}
                                                                </p>
                                                            @endif

                                                        </div>

                                                    @endif

                                                </div>

                                            @empty

                                                <div class="alert alert-info">
                                                    Aucun programme disponible.
                                                </div>

                                            @endforelse

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <button class="accordion-header" wire:ignore>
                                <h6><i class="las la-clipboard-list title-icon"></i>Détails</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                            </button>
                            <div class="accordion-body" wire:ignore>
                                <div class="espace">
                                    <div class="prog-evt-wrapper">

                                        <div class="prog-evt-title">
                                            DETAILS
                                        </div>

                                        <div class="prog-evt-timeline">
                                            @php
                                                $details = $event->programmes
                                                    ->where('type', 'Détails')
                                                    ->sortBy('order')
                                                    ->values();
                                            @endphp

                                            @forelse ($details as $index => $del)
                                                <div class="prog-evt-item {{ $index % 2 == 0 ? 'prog-evt-left' : 'prog-evt-right' }}">
                                                    {{-- AFFICHAGE GAUCHE --}}
                                                    @if ($index % 2 == 0)
                                                        <div class="prog-evt-content">

                                                            <h3>{{ strtoupper($del->titre) }}</h3>

                                                            @if ($del->detail)
                                                                <p>
                                                                    {!! nl2br(e($del->detail)) !!}
                                                                </p>
                                                            @endif

                                                        </div>

                                                        <div class="prog-evt-icon">
                                                            <i class="las {{ $del->icone ?? 'la-calendar' }}"></i>
                                                        </div>

                                                    {{-- AFFICHAGE DROITE --}}
                                                    @else

                                                        <div class="prog-evt-icon">
                                                            <i class="las {{ $del->icone ?? 'la-calendar' }}"></i>
                                                        </div>

                                                        <div class="prog-evt-content">
                                                            <h3>{{ strtoupper($del->titre) }}</h3>
                                                            @if ($del->detail)
                                                                <p>
                                                                    {!! nl2br(e($del->detail)) !!}
                                                                </p>
                                                            @endif

                                                        </div>
                                                    @endif
                                                </div>
                                            @empty
                                                <div>
                                                    Aucun détail disponible.
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <button class="accordion-header" wire:ignore>
                                <h6><i class="las la-edit title-icon"></i>Livre D'or</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                            </button>
                            <div class="accordion-body" wire:ignore>
                                <div class="espace">
                                    <p class="espace-title">Partagez quelques mots, vos pensées ou vos bénédictions pour rendre cette journée encore plus mémorable.</p>
                                    <x-form.textarea
                                        label="" 
                                        wire:model="message"
                                        placeholder="Ecrivez votre message ici."
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <button class="accordion-header" wire:ignore>
                                <h6><i class="las la-sliders-h title-icon"></i>Vos goûts comptent</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                            </button>
                            <div class="accordion-body" wire:ignore>
                                <div class="espace">
                                    <p class="espace-title">Aidez-nous à préparer un moment qui vous ressemble en sélectionnant vos préférences culinaires, boissons favorites et besoins particuliers.</p> <br>
                                
                                    @php
                                        $productsByCategory = $event->products->groupBy('category');
                                    @endphp

                                    @forelse($productsByCategory as $category => $products)

                                        <!-- CATEGORY TITLE -->
                                        <div class="evt-product-category">

                                            <h3 class="evt-product-category-title">
                                                {{ $category }}
                                            </h3>

                                            <!-- PRODUCTS -->
                                            <div class="evt-product-list">
                                                @foreach($products as $product)
                                                    <div class="evt-product-item">
                                                        <x-form.toggle
                                                            label="{{ $product->name }}"
                                                            wire:model="produits"
                                                            value="{{ $product->id }}" />
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        
                                    @empty
                                        
                                        <div class="text-muted">
                                            Aucun produit
                                        </div>
                                    
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <button class="accordion-header" wire:ignore>
                                <h6><i class="las la-user-plus title-icon"></i>Confirmez votre présence</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                            </button>
                            <div class="accordion-body" wire:ignore>
                                <div class="espace">
                                    <p class="espace-title">Nous serions honorés de votre présence. Merci de compléter ce formulaire afin de finaliser votre confirmation.</p> <br>
                                    <x-form.input wire:model="name" placeholder="Noms..." />
                                    <x-form.input type="email" wire:model="email" placeholder="E-mail..." />
                                    <x-form.input wire:model="phone" placeholder="Téléphone..." />
                                </div>
                            </div>
                        </div>

                        <div class="foot-invit">
                            <div class="app-form-group">
                                <label class="app-toggle">
                                    <input type="checkbox" wire:model.live="isPrivate">
                                    <span class="slider"></span>

                                    <span class="text-toggle">
                                        <strong>
                                            {{ $isPrivate ? 'J\'accepté' : 'Merci, mais non' }}
                                        </strong>
                                    </span>

                                </label>
                            </div>

                            <button class="btn btn-primary">
                                <i class="las la-check"></i>Envoyer
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bas_invitation">
                    <p>Invitation réaliser par <strong>libyangi</strong>, pour savoir plus,</p>
                    
                    @php
                        $message = bin2hex("Bonjour, j'aimerais avoir plus d'informations sur votre service.");
                        $whatsappUrl = "https://wa.me/243827431252?text=" . urlencode($message);
                    @endphp

                    <a href="{{ $whatsappUrl }}" target="_black">
                        <i class="las la-arrow-right"></i> 
                        Contactez-nous sur Whatsapp
                    </a>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll(".accordion-header").forEach(header => {
            header.addEventListener("click", () => {
                const body = header.nextElementSibling;
                const icon = header.querySelector(".accordion-icon i");

                const isOpen =
                    body.style.maxHeight &&
                    body.style.maxHeight !== "0px";

                /* =========================
                FERMER TOUS
                ========================= */
                document.querySelectorAll(".accordion-body").forEach(b => {
                    b.style.maxHeight = "0";
                    b.style.paddingTop = "0";
                    b.style.paddingBottom = "0";
                });

                /* =========================
                RESET ICONS
                ========================= */
                document.querySelectorAll(".accordion-icon i").forEach(i => {
                    i.classList.remove("la-minus");
                    i.classList.add("la-plus");
                });

                /* =========================
                OUVRIR SI FERMÉ
                ========================= */
                if (!isOpen) {
                    body.style.maxHeight = body.scrollHeight + "px";
                    body.style.paddingTop = "15px";
                    body.style.paddingBottom = "15px";
                    icon.classList.remove("la-plus");
                    icon.classList.add("la-minus");
                }

                });
            });
        </script>

        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.min.js"></script>

        @php
            $adresses = $event->addresses->map(function ($a) {
                return [
                    'id' => $a->id,
                    'address' => $a->address,
                    'latitude' => $a->latitude,
                    'longitude' => $a->longitude,
                ];
            });
        @endphp
        <script>
            function initMaps() {

                const adresses = @json($adresses);

                adresses.forEach((item) => {

                    if (!item.latitude || !item.longitude) return;

                    const mapId = `map-${item.id}`;
                    const mapElement = document.getElementById(mapId);

                    if (!mapElement || mapElement._leaflet_id) return;

                    const map = L.map(mapId);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);

                    map.setView([item.latitude, item.longitude], 15);

                    L.marker([item.latitude, item.longitude])
                        .addTo(map)
                        .bindPopup(item.address);

                    setTimeout(() => map.invalidateSize(), 300);
                });
            }

            document.addEventListener('DOMContentLoaded', () => setTimeout(initMaps, 500));
            document.addEventListener('livewire:update', () => setTimeout(initMaps, 500));
            document.addEventListener('livewire:navigated', () => setTimeout(initMaps, 500));
        </script>

    @endif
    
    <!--
        ==========================================
        LOADING PROFESSIONNEL
        ==========================================
        - Attend que la page soit complètement chargée
        - Garde le loader minimum 20 secondes
        - Puis fade out smooth
    -->
    <script>
        window.addEventListener("load", () => {
            const loader = document.getElementById("loader");
            const minimumLoadingTime = 10000; // 10 sec
            setTimeout(() => {
                loader.classList.add("hidden");
            }, minimumLoadingTime);
        });
    </script>    

    <!-- ANIMATION : FEUILLES QUI TOMBENT -->
    <script>
        for (let i = 0; i < 25; i++) {
            let p = document.createElement("div");
            p.className = "particle";

            p.style.left = Math.random() * 100 + "vw";
            p.style.top = "-10vh"; // démarre en haut

            p.style.animationDuration = 5 + Math.random() * 10 + "s";

            document.body.appendChild(p);
        }
    </script>

    <!-- TOAST -->
    <script>
        function toastSystem() {
            return {
                toasts: [],

                add(data) {

                    const styles = {
                        success: { icon: '✔', color: 'var(--theme-event-lib-success)' },
                        error:   { icon: '✖', color: 'var(--color-badge)' },
                        info:    { icon: 'ℹ', color: 'var(--secondary)' },
                        warning: { icon: '⚠', color: 'var(--accent)' },
                    };

                    let type = data.type ?? 'info';
                    let config = styles[type];

                    let toast = {
                        message: data.message ?? '',
                        icon: config.icon,
                        color: config.color,
                        show: true
                    };

                    this.toasts.push(toast);

                    setTimeout(() => {
                        toast.show = false;
                        setTimeout(() => {
                            this.toasts.shift();
                        }, 300);
                    }, data.duration ?? 3000);
                }
            }
        }
    </script>
</div>
