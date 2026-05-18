<div style="background:
                radial-gradient(circle at top right, rgba(124,58,237,.10), transparent 30%),
                #f8fafc;min-height: 100vh;height: auto;padding: 60px 0;overflow:hidden;display: flex;justify-content: center;
                align-items: start;">
    
    <style>
        :root{
            --primary: #9564ff;
            --secondary: #c6b2ef;
            --accent: #f97316;
            --primary-light:#a855f7;
            --theme-event-lib-secondary:#0f172a;
            --theme-event-lib-bg:#f8fafc;
            --theme-event-lib-card:#ffffff;
            --theme-event-lib-text:#1e293b;
            --theme-event-lib-text1:#ffffff;
            --theme-event-lib-border:#e2e8f0;
            --theme-event-lib-success:#22c55e;

            --theme-event-lib-radius:24px;
            --theme-event-lib-shadow:0 10px 35px rgba(15,23,42,.08);
            --theme-event-lib-transition:.35s ease;

            --font-base: Arial, Helvetica, sans-serif;

            --border: rgba(0, 0, 0, 0.3);
            --muted: #94a3b8;
            --text: #f2f2f4;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            --shadow-soft: 0 6px 15px rgba(0, 0, 0, 0.041);
            --shadow-soft-top: 0 -6px 15px rgba(0, 0, 0, 0.041);
        }

        /* =========================================================
            PAGE WRAPPER
        ========================================================== */
        .cadre-theme-event{
            width:95%;
            max-width:800px;
            background: var(--theme-event-lib-card);
            border: 1px solid var(--theme-event-lib-border);
            padding: 20px;
            border-radius: var(--theme-event-lib-radius);
            box-shadow: var(--theme-event-lib-shadow);
            position: relative;
        }

        .type-event{
            position: absolute;
            top: 30px;
            left: 30px;
            padding: 0 10px 0 0;
            border-radius: var(--theme-event-lib-radius);
            box-shadow: var(--theme-event-lib-shadow);
            background: var(--theme-event-lib-card);
            border: 1px solid var(--primary);
            display:flex;
            justify-content:start;
            align-items: center;
            flex-wrap: nowrap;
            gap: 10px;
        }

        .type-event i{
            width:40px;
            height:40px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:18px;
            background:linear-gradient(135deg,var(--primary),var(--primary-light));
            color:var(--theme-event-lib-text1);
            font-size:20px;
        }

        .type-event span{
            color: var(--primary);
            font-weight: 600;        
        }

        .container-theme-event{
            display:flex;
            align-items:center;
            justify-content:start;
            flex-direction: column;
        }

                /* =========================================================
            IMAGE
        ========================================================== */
        .image-theme-event{
            display:flex;
            align-items:center;
            justify-content:center;
            width: 100%;
            height: auto;
            border-radius: var(--theme-event-lib-radius);
        }

                .theme-event-lib-hero-image{
            width:100%;
            height:auto;
            object-fit:cover;
        }

        .organisateur-theme-event{
            padding: 30px 20px;
            background: #64748b69;
            border-radius: 50%;
            border: 2px solid var(--theme-event-lib-text1);
            overflow: hidden;
            position: absolute;
        }

        .organisateur-theme-event p{
            color: var (--theme-event-lib-text1);
            font-size: 40px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

                /* =========================================================
            INFOS
        ========================================================== */
        .infos-theme-event{
            background: var(--theme-event-lib-card);
            padding: 20px 0;
            /* transform: translateY(-70px); */
        }

        .infos-theme-event::after{
            transform: translateY(-100px);
            content: "";
            width: 100%;
            height: 600px;
            background: red;
            transition: 0.3s;
            z-index: 100;
        }

        .message-theme{
            line-height: 25px;
        }

        /* Accordion */
        .accordion-theme-event {
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .accordion-item {
            border: 1px solid var(--theme-event-lib-border,#e2e8f0);
                        border-radius: var(--theme-event-lib-radius);
            box-shadow: var(--theme-event-lib-shadow);
            background: var(--theme-event-lib-card);
            overflow: hidden;
        }

        .accordion-header {
            width: 100%;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 16px;
            background: var(--theme-event-lib-bg);
            border: none;
            outline: none;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
        }

        .accordion-header:hover {
            background: var(--theme-event-lib-border);
        }
        .title-icon{
                        font-size: 16px;
            transition: transform 0.3s ease;
            margin-right: 3px;
        }

        .accordion-icon i{
            font-size: 20px;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .accordion-body {
            max-height: 0;
            overflow: hidden;
            padding: 0 20px; /* padding horizontal seulement pour éviter de bloquer l'animation */
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .accordion-body p {
            margin: 15px 0;
            font-size: 16px;
            color: var(--color-text3);
        }

        .accordion-body ul {
            margin: 15px 15px 20px;
        }

        /* When open */
        .accordion-item.active .accordion-body {
            padding: 15px 20px;
            max-height: 500px; /* adjust if content is bigger */
        }

        .accordion-item.active .accordion-icon {
            transform: rotate(45deg);
        }

        .espace{
            margin-bottom: 40px;
        }

        .espace-title{
            color: var(--primary) !important;
            margin: 0 !important;
            padding: 0 !important;
            font-weight: 600;
            font-size: 15px;
        }

        /* Form Group */
        .app-form-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 14px;
            font-family: var(--font-base);
        }

        /* Label */
        .app-form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* Input et select */
        .app-form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: var(--transition-fast);
            color: var(--primary);
        }

        .app-form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 5pxvar (--primary);
        }

        /* Error */
        .app-form-group.is-error .app-form-control {
            border-color: var(--primary);
        }

        .app-error-text {
            color: var(--accent);
            font-size: 0.8rem;
            margin-top: 2px;
        }

        .app-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            color: var(--primary);
        }

        .app-checkbox input {
            display: none;
        }

        .app-checkbox .checkmark {
            width: 18px;
            height: 18px;
            border: 2px solid var(--primary);
            border-radius: 4px;
            position: relative;
        }

        .app-checkbox input:checked + .checkmark {
            background: var(--primary);
        }

        .app-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .app-toggle input {
            display: none;
        }

        .app-toggle .slider {
            width: 42px;
            height: 22px;
            background: var(--muted);
            border-radius: 22px;
            position: relative;
            cursor: pointer;
        }

        .app-toggle .slider::before {
            content: "";
            position: absolute;
            width: 18px;
            height: 18px;
            top: 2px;
            left: 2px;
            background: var(--text);
            border-radius: 50%;
            transition: 0.3s;
        }

        .app-toggle input:checked + .slider {
            background: var(--primary);
        }

        .app-toggle input:checked + .slider::before {
            transform: translateX(20px);
        }

        .app-toggle .text-toggle{
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
        }

        .app-toggle .text-toggle:checked{
            color: var(--primary);
        }

        /* Base Button */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.25s ease;
            gap: 8px;
            user-select: none;
        }

        /* Tailles */
        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }
        .btn-md {
            padding: 10px 18px;
            font-size: 14px;
        }
        .btn-lg {
            padding: 14px 24px;
            font-size: 16px;
        }

        /* Bouton principal */
        .btn-primary {
            background: var(--primary);
            background: linear-gradient(135deg, var(--primary), #c0a6f8);
            color: var(--text);
            box-shadow: var(--shadow-soft);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        /* Bouton danger */
        .btn-danger {
            background: #ef4444;
            background: linear-gradient(135deg, #ef4444, rgb(255, 136, 136));
            color: var(--text);
            box-shadow: var(--shadow-soft);
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        /* Bouton succès */
        .btn-success {
            background-color: #22c55e;
            background: linear-gradient(135deg, #52ff91, #22c55e);
            color: var(--text);
            box-shadow: var(--shadow-soft);
        }

        /* Bouton warning */
        .btn-warning {
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            color: var(--text);
        }

        .btn:hover {
            opacity: 0.7;
        }

        /* Bouton outline */
        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
        }

        .btn-outline:hover {
            background: var(--accent);
            color: var(--text);
        }

        /* Bouton soft (très utilisé en dashboard) */
        .btn-soft {
            background: rgba(249, 115, 22, 0.15); /* basé sur accent */
            color: var(--accent);
        }

        .btn-soft:hover {
            background: rgba(249, 115, 22, 0.25);
        }

        /* Bouton icône */
        .btn-icon {
            width: 40px;
            height: 40px;
            padding: 0;
            border-radius: 50%;
        }

        /* Bouton loading */
        .btn-loading {
            pointer-events: none;
            opacity: 0.6;
        }

        
        /* ================================
        DISPLAY GRID SYSTEM
        Prefix: d-gril-
        ================================ */

        /* Container */
        .d-gril-container {
            width: 100%;
            margin: 0 auto 30px;
        }

        /* Grid */
        .d-gril-row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 20px;
            width: 100%;
        }

        /* ================================
        COLUMNS DESKTOP
        ================================ */

        .d-gril-col-1 {
            grid-column: span 1;
        }
        .d-gril-col-2 {
            grid-column: span 2;
        }
        .d-gril-col-3 {
            grid-column: span 3;
        }
        .d-gril-col-4 {
            grid-column: span 4;
        }
        .d-gril-col-5 {
            grid-column: span 5;
        }
        .d-gril-col-6 {
            grid-column: span 6;
        }
        .d-gril-col-7 {
            grid-column: span 7;
        }
        .d-gril-col-8 {
            grid-column: span 8;
        }
        .d-gril-col-9 {
            grid-column: span 9;
        }
        .d-gril-col-10 {
            grid-column: span 10;
        }
        .d-gril-col-11 {
            grid-column: span 11;
        }
        .d-gril-col-12 {
            grid-column: span 12;
        }

        /* ================================
        TABLET RESPONSIVE
        ================================ */

        @media (max-width: 992px) {
            .d-gril-md-1 {
                grid-column: span 1;
            }
            .d-gril-md-2 {
                grid-column: span 2;
            }
            .d-gril-md-3 {
                grid-column: span 3;
            }
            .d-gril-md-4 {
                grid-column: span 4;
            }
            .d-gril-md-5 {
                grid-column: span 5;
            }
            .d-gril-md-6 {
                grid-column: span 6;
            }
            .d-gril-md-7 {
                grid-column: span 7;
            }
            .d-gril-md-8 {
                grid-column: span 8;
            }
            .d-gril-md-9 {
                grid-column: span 9;
            }
            .d-gril-md-10 {
                grid-column: span 10;
            }
            .d-gril-md-11 {
                grid-column: span 11;
            }
            .d-gril-md-12 {
                grid-column: span 12;
            }
        }

        /* ================================
        MOBILE RESPONSIVE
        ================================ */

        @media (max-width: 768px) {
            .d-gril-row {
                gap: 15px;
            }

            .d-gril-sm-1 {
                grid-column: span 1;
            }
            .d-gril-sm-2 {
                grid-column: span 2;
            }
            .d-gril-sm-3 {
                grid-column: span 3;
            }
            .d-gril-sm-4 {
                grid-column: span 4;
            }
            .d-gril-sm-5 {
                grid-column: span 5;
            }
            .d-gril-sm-6 {
                grid-column: span 6;
            }
            .d-gril-sm-7 {
                grid-column: span 7;
            }
            .d-gril-sm-8 {
                grid-column: span 8;
            }
            .d-gril-sm-9 {
                grid-column: span 9;
            }
            .d-gril-sm-10 {
                grid-column: span 10;
            }
            .d-gril-sm-11 {
                grid-column: span 11;
            }
            .d-gril-sm-12 {
                grid-column: span 12;
            }
        }

        /* ================================
        EXTRA SMALL MOBILE
        ================================ */

        @media (max-width: 576px) {
            .d-gril-row {
                grid-template-columns: repeat(1, 1fr);
            }

            [class*="d-gril-col-"],
            [class*="d-gril-md-"],
            [class*="d-gril-sm-"] {
                grid-column: span 1 !important;
            }
        }

        /* ================================
        FORM ELEMENT STYLE
        ================================ */

        .d-gril-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .bas_invitation{
            display: flex;
            justify-content: center;
            align-content: center;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            font-size: 14px;
        }

        .bas_invitation p{
            color: var(--primary);
            text-align: center;
        }

        .bas_invitation a{
            text-align: center;
            text-decoration: none;
        }
    </style>

    <div class="cadre-theme-event">
        {{-- TYPE FLOTTANT --}}
        <div class="type-event">
            <i class="las la-star"></i>
            <span>Événement Premium</span>
        </div>

        <div class="container-theme-event">
            {{-- HERO --}}
            @if($event->image)
                <div class="image-theme-event">
                    <img src="{{ asset('storage/'.$event->image) }}" class="theme-event-lib-hero-image">
                    <div class="organisateur-theme-event">
                        <p>Jules & Maria</p>
                    </div>
                </div>
            @endif

            {{-- INFOS --}}
            <div class="infos-theme-event">
                {{-- INFO PRINCIPAL --}}
                <div class="infos-theme-message">
                    <div class="message-theme">
                        {!! $event->description !!}
                    </div>
                    <div class="date-heure-theme">
                        <span>15h00</span>
                    </div>
                </div>

                <!-- Accordion -->
                <form wire:submit.prevent="save" class="accordion-theme-event">

                    <div class="accordion-item">
                        <button class="accordion-header" wire:ignore>
                            <h6><i class="las la-calendar title-icon"></i>Adresse</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                        </button>
                        <div class="accordion-body" wire:ignore>
                            {{-- @php
                                $adresse = $event->adresses->first()?->adresse;
                                $latitude = $event->adresses->first()?->latitude;
                                $longitude = $event->adresses->first()?->longitude;
                            @endphp

                            <div class="espace">
                                @if($adresse !=null and $latitude != null and $longitude != null)
                                <p class="espace-title">Retrouvez l'adresse de l'endroit.</p>
                                <button id="retry-geoloc" style="display:none; z-index: 1000; margin-bottom:15px;">Activer ma localisation</button>
                                <div id="map" style="height: 500px;width:100%;border-radius:5px;margin-bottom:30px;"></div>
                                @endif
                            </div> --}}
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header" wire:ignore>
                            <h6><i class="las la-calendar title-icon"></i>Programme</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                        </button>
                        <div class="accordion-body" wire:ignore>
                            <div class="espace">
                                <p class="espace-title">Titre...</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header" wire:ignore>
                            <h6><i class="las la-calendar title-icon"></i>Livre D'or</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                        </button>
                        <div class="accordion-body" wire:ignore>
                            <div class="espace">
                                <x-form.textarea
                                    label="Laissez un message !" 
                                    wire:model="message"
                                    placeholder="Ecrivez votre message ici."
                                />
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header" wire:ignore>
                            <h6><i class="las la-calendar title-icon"></i>Vos préférences</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                        </button>
                        <div class="accordion-body" wire:ignore>
                            <div class="d-gril-container">
                                <p class="espace-title">Texte...</p> <br>
                                <div class="d-gril-row">
                                    @forelse($event->products as $product)
                                        <div class="d-gril-col-6 d-gril-md-6 d-gril-6">
                                            <div class="d-gril-group">
                                                <x-form.toggle label="{{ $product->name }}" wire:model="produit[]" />
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-muted">Aucun produit</div>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header" wire:ignore>
                            <h6><i class="las la-calendar title-icon"></i>Réagir à l'invitation</h6> <span class="accordion-icon"> <i class="las la-plus"></i></span>
                        </button>
                        <div class="accordion-body" wire:ignore>
                            <br><br>
                            <div class="espace">
                                <p class="espace-title">Texte...</p>
                                <x-form.input label="Nom" wire:model="name" placeholder="Nom" required />
                                <x-form.input label="Téléphone" wire:model="phone" placeholder="080 000 000 000" />
                                <x-form.input label="Email" type="email" wire:model="email" placeholder="exemple@gmaim.com" />
                                <x-form.input type="hidden" wire:model="lien" value="{{ url()->current() }}" required />

                                <div class="app-form-group">
                                    <label class="app-toggle">
                                        <input type="checkbox" wire:model.live="isPrivate">

                                        <span class="slider"></span>

                                        <span class="app-toggle-text">
                                            Réponse : {{ $isPrivate ? 'J\'accepté' : 'Merci, mais non' }}
                                        </span>
                                    </label>
                                </div>
                                <button class="btn btn-primary">
                                    <i class="las la-check"></i>Envoyer
                                </button>
                            </div>
                        
                        </div>
                    </div>

                </form>
            </div>

            
            <div class="bas_invitation">
                <p>Invitation réaliser par <strong>libyangi</strong>, pour savoir plus,</p>
                
                @php
                    $message = "Bonjour, j'aimerais avoir plus d'informations sur votre service.";
                    $whatsappUrl = "https://wa.me/243827431252?text=" . urlencode($message);
                @endphp
                <a href="{{ $whatsappUrl }}" target="_black" style="z-index: 9000;">👉 Contactez-nous sur Whatsapp</a>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll(".accordion-header").forEach(header => {
            header.addEventListener("click", () => {
                const body = header.nextElementSibling;

                // Si l'élément est déjà ouvert, on ferme
                if (body.style.maxHeight && body.style.maxHeight !== "0px") {
                    body.style.maxHeight = "0";
                    body.style.paddingTop = "0";
                    body.style.paddingBottom = "0";
                } else {
                    // On ferme les autres accordéons si besoin
                    document.querySelectorAll(".accordion-body").forEach(b => {
                        b.style.maxHeight = "0";
                        b.style.paddingTop = "0";
                        b.style.paddingBottom = "0";
                    });

                    // On ouvre celui cliqué
                    body.style.maxHeight = body.scrollHeight + "px"; // scrollHeight = hauteur réelle du contenu
                    body.style.paddingTop = "15px";
                    body.style.paddingBottom = "15px";
                }
            });
        });
    </script>

                <!-- Leaflet CSS & JS -->
    {{-- <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.min.js"></script>
    @if($adresse !=null and $latitude != null and $longitude != null)
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const destLat = {{ $latitude }};
                const destLng = {{ $longitude }};
                const retryBtn = document.getElementById('retry-geoloc');

                // Initialiser la carte sur la destination
                const map = L.map('map').setView([destLat, destLng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Marqueur destination toujours affiché
                L.marker([destLat, destLng]).addTo(map)
                    .bindPopup("{{ ucfirst($adresse) }}").openPopup();

                // Fonction pour demander la position et afficher l’itinéraire
                function getAndShowRoute() {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const userLat = position.coords.latitude;
                            const userLng = position.coords.longitude;

                            map.setView([userLat, userLng], 13);

                            L.marker([userLat, userLng]).addTo(map)
                                .bindPopup('Votre position actuelle').openPopup();

                            L.Routing.control({
                                waypoints: [
                                    L.latLng(userLat, userLng),
                                    L.latLng(destLat, destLng)
                                ],
                                routeWhileDragging: false,
                                draggableWaypoints: false,
                                addWaypoints: false
                            }).addTo(map);

                            retryBtn.style.display = 'none'; // cacher le bouton si affiché
                        },
                        function (error) {
                            alert("La géolocalisation a été refusée ou a échoué");
                            retryBtn.style.display = 'block';
                        }
                    );
                }

                // Vérifier si le navigateur supporte la géolocalisation
                if (navigator.geolocation) {
                    getAndShowRoute();
                } else {
                    alert("La géolocalisation n'est pas supportée par votre navigateur.");
                }

                // Bouton pour relancer la demande de localisation
                retryBtn.addEventListener('click', function () {
                    getAndShowRoute();
                });
            });
        </script>
    @endif --}}
</div>
