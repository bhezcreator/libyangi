<div>

    {{-- =========================================================
        THEME EVENT LIB - STYLES
    ========================================================== --}}
    <style>

        :root{
            --theme-event-lib-primary:#7c3aed;
            --theme-event-lib-primary-light:#a855f7;
            --theme-event-lib-secondary:#0f172a;
            --theme-event-lib-bg:#f8fafc;
            --theme-event-lib-card:#ffffff;
            --theme-event-lib-text:#1e293b;
            --theme-event-lib-muted:#64748b;
            --theme-event-lib-border:#e2e8f0;
            --theme-event-lib-success:#22c55e;

            --theme-event-lib-radius:24px;
            --theme-event-lib-shadow:0 10px 35px rgba(15,23,42,.08);
            --theme-event-lib-transition:.35s ease;
        }

        /* =========================================================
            PAGE WRAPPER
        ========================================================== */
        .theme-event-lib-page{
            min-height:100vh;
            background:
                radial-gradient(circle at top right, rgba(124,58,237,.10), transparent 30%),
                var(--theme-event-lib-bg);
            padding:60px 0;
            overflow:hidden;
        }

        .theme-event-lib-container{
            width:94%;
            max-width:1280px;
            margin:auto;
        }

        /* =========================================================
            LOADER
        ========================================================== */
        .theme-event-lib-loading{
            position:fixed;
            inset:0;
            background:#fff;
            z-index:9999;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            gap:25px;
        }

        .theme-event-lib-spinner{
            width:90px;
            height:90px;
            border-radius:50%;
            border:8px solid rgba(124,58,237,.12);
            border-top-color:var(--theme-event-lib-primary);
            animation:spin 1s linear infinite;
        }

        @keyframes spin{
            to{ transform:rotate(360deg); }
        }

        /* =========================================================
            HERO
        ========================================================== */
        .theme-event-lib-hero{
            display:grid;
            grid-template-columns:1.1fr .9fr;
            gap:40px;
            align-items:center;
            margin-bottom:60px;
        }

        .theme-event-lib-badge{
            display:inline-flex;
            align-items:center;
            gap:10px;
            padding:12px 22px;
            border-radius:100px;
            font-weight:700;
            background:rgba(124,58,237,.12);
            color:var(--theme-event-lib-primary);
            margin-bottom:20px;
        }

        .theme-event-lib-title{
            font-size:clamp(2.5rem,6vw,5rem);
            font-weight:900;
            color:var(--theme-event-lib-secondary);
            line-height:1;
        }

        .theme-event-lib-subtitle{
            margin-top:15px;
            color:var(--theme-event-lib-muted);
            font-size:1.1rem;
            line-height:1.7;
            max-width:700px;
        }

        .theme-event-lib-hero-image{
            width:100%;
            height:560px;
            object-fit:cover;
            border-radius:32px;
            box-shadow:var(--theme-event-lib-shadow);
        }

        .theme-event-lib-floating-card{
            position:absolute;
            bottom:20px;
            left:20px;
            background:rgba(255,255,255,.92);
            backdrop-filter:blur(10px);
            padding:16px 20px;
            border-radius:18px;
            box-shadow:var(--theme-event-lib-shadow);
        }

        /* =========================================================
            INFO CARDS
        ========================================================== */
        .theme-event-lib-info-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            gap:25px;
            margin-bottom:60px;
        }

        .theme-event-lib-info-card{
            background:#fff;
            border:1px solid var(--theme-event-lib-border);
            border-radius:var(--theme-event-lib-radius);
            padding:28px;
            box-shadow:var(--theme-event-lib-shadow);
            transition:var(--theme-event-lib-transition);
        }

        .theme-event-lib-info-card:hover{
            transform:translateY(-6px);
        }

        .theme-event-lib-info-icon{
            width:60px;
            height:60px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:18px;
            background:linear-gradient(135deg,var(--theme-event-lib-primary),var(--theme-event-lib-primary-light));
            color:#fff;
            font-size:26px;
            margin-bottom:18px;
        }

        .theme-event-lib-info-title{
            font-weight:800;
            color:var(--theme-event-lib-secondary);
            margin-bottom:8px;
        }

        /* =========================================================
            ACCORDION
        ========================================================== */
        .theme-event-lib-accordion-item{
            border:none !important;
            border-radius:24px !important;
            margin-bottom:18px;
            overflow:hidden;
            box-shadow:var(--theme-event-lib-shadow);
        }

        .theme-event-lib-accordion-button{
            padding:22px !important;
            font-weight:800;
            background:#fff !important;
            color:var(--theme-event-lib-secondary) !important;
            box-shadow:none !important;
        }

        .theme-event-lib-accordion-body{
            background:#fff;
            padding:26px;
        }

        /* =========================================================
            PRODUCTS
        ========================================================== */
        .theme-event-lib-category-title{
            font-size:1.2rem;
            font-weight:800;
            margin-bottom:15px;
        }

        .theme-event-lib-product{
            display:flex;
            justify-content:space-between;
            padding:14px 0;
            border-bottom:1px dashed var(--theme-event-lib-border);
        }

        /* =========================================================
            GUESTS
        ========================================================== */
        .theme-event-lib-guests-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
            gap:20px;
        }

        .theme-event-lib-guest{
            padding:20px;
            border-radius:22px;
            border:1px solid var(--theme-event-lib-border);
            background:#fff;
            transition:var(--theme-event-lib-transition);
        }

        .theme-event-lib-guest:hover{
            transform:translateY(-4px);
        }

        .theme-event-lib-status{
            background:rgba(34,197,94,.12);
            color:var(--theme-event-lib-success);
            padding:6px 12px;
            border-radius:50px;
            font-size:.8rem;
            font-weight:700;
        }

        /* =========================================================
            BUTTON
        ========================================================== */
        .theme-event-lib-btn{
            background:linear-gradient(135deg,var(--theme-event-lib-primary),var(--theme-event-lib-primary-light));
            border:none;
            color:#fff;
            padding:18px 36px;
            border-radius:18px;
            font-weight:800;
            transition:var(--theme-event-lib-transition);
            box-shadow:0 15px 30px rgba(124,58,237,.25);
        }

        .theme-event-lib-btn:hover{
            transform:scale(1.03);
        }

        /* =========================================================
            ANIMATION
        ========================================================== */
        .theme-event-lib-fade-up{
            animation:fadeUp .7s ease;
        }

        @keyframes fadeUp{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        /* =========================================================
            RESPONSIVE
        ========================================================== */
        @media(max-width:992px){
            .theme-event-lib-hero{
                grid-template-columns:1fr;
            }

            .theme-event-lib-hero-image{
                height:400px;
            }
        }

        @media(max-width:768px){
            .theme-event-lib-page{
                padding:35px 0;
            }

            .theme-event-lib-title{
                font-size:2.5rem;
            }
        }

    </style>

    {{-- =========================================================
        LOADER
    ========================================================== --}}
    @if(!$loaded)

        <div class="theme-event-lib-loading">
            <div class="theme-event-lib-spinner"></div>
            <h3>Chargement de l'événement...</h3>
        </div>

    @else

        {{-- =====================================================
            PAGE
        ====================================================== --}}
        <div class="theme-event-lib-page">

            <div class="theme-event-lib-container">

                {{-- HERO --}}
                <div class="theme-event-lib-hero theme-event-lib-fade-up">

                    <div>

                        <div class="theme-event-lib-badge">
                            <i class="las la-calendar"></i>
                            Événement Premium
                        </div>

                        <h1 class="theme-event-lib-title">
                            {{ $event->title }}
                        </h1>

                        <p class="theme-event-lib-subtitle">
                            {{ $event->description }}
                        </p>

                        <div class="mt-4">
                            <button wire:click="sendInvitation" class="theme-event-lib-btn">
                                <i class="las la-paper-plane me-2"></i>
                                Envoyer l'invitation
                            </button>
                        </div>

                    </div>

                    @if($event->image)
                        <div style="position:relative;">
                            <img src="{{ asset('storage/'.$event->image) }}" class="theme-event-lib-hero-image">

                            <div class="theme-event-lib-floating-card">
                                <strong>{{ $event->type }}</strong>
                                <div class="text-muted small">Événement exclusif</div>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- INFO --}}
                <div class="theme-event-lib-info-grid">

                    <div class="theme-event-lib-info-card">
                        <div class="theme-event-lib-info-icon"><i class="las la-calendar-day"></i></div>
                        <div class="theme-event-lib-info-title">Date début</div>
                        <div class="text-muted">{{ $event->start_date }}</div>
                    </div>

                    <div class="theme-event-lib-info-card">
                        <div class="theme-event-lib-info-icon"><i class="las la-calendar-check"></i></div>
                        <div class="theme-event-lib-info-title">Date fin</div>
                        <div class="text-muted">{{ $event->end_date }}</div>
                    </div>

                    <div class="theme-event-lib-info-card">
                        <div class="theme-event-lib-info-icon"><i class="las la-layer-group"></i></div>
                        <div class="theme-event-lib-info-title">Type</div>
                        <div class="text-muted">{{ $event->type }}</div>
                    </div>

                </div>

                {{-- ACCORDION --}}
                <div class="accordion theme-event-lib-accordion">

                    {{-- ADDRESSES --}}
                    <div class="accordion-item theme-event-lib-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button theme-event-lib-accordion-button" data-bs-toggle="collapse" data-bs-target="#addr">
                                <i class="las la-map-marker-alt me-2"></i> Adresses
                            </button>
                        </h2>

                        <div id="addr" class="accordion-collapse collapse show">
                            <div class="accordion-body theme-event-lib-accordion-body">

                                @forelse($event->addresses as $address)
                                    <div class="mb-3">
                                        <strong>{{ $address->title ?? 'Adresse' }}</strong>
                                        <div class="text-muted">{{ $address->address }}</div>
                                    </div>
                                @empty
                                    <div class="text-muted">Aucune adresse</div>
                                @endforelse

                            </div>
                        </div>
                    </div>

                    {{-- PRODUCTS --}}
                    <div class="accordion-item theme-event-lib-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed theme-event-lib-accordion-button" data-bs-toggle="collapse" data-bs-target="#prod">
                                <i class="las la-utensils me-2"></i> Produits
                            </button>
                        </h2>

                        <div id="prod" class="accordion-collapse collapse">
                            <div class="accordion-body theme-event-lib-accordion-body">

                                @forelse($productsByCategory as $category => $products)

                                    <div class="mb-4">
                                        <div class="theme-event-lib-category-title">{{ $category }}</div>

                                        @foreach($products as $product)
                                            <div class="theme-event-lib-product">
                                                <span>{{ $product->name }}</span>
                                                <span class="text-muted">{{ $product->pivot->quantity ?? '' }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                @empty
                                    <div class="text-muted">Aucun produit</div>
                                @endforelse

                            </div>
                        </div>
                    </div>

                    {{-- GUESTS --}}
                    <div class="accordion-item theme-event-lib-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed theme-event-lib-accordion-button" data-bs-toggle="collapse" data-bs-target="#guest">
                                <i class="las la-users me-2"></i> Invités
                            </button>
                        </h2>

                        <div id="guest" class="accordion-collapse collapse">
                            <div class="accordion-body theme-event-lib-accordion-body">

                                <div class="theme-event-lib-guests-grid">

                                    @forelse($event->guests as $guest)

                                        <div class="theme-event-lib-guest">

                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <strong>{{ $guest->name }}</strong>
                                                    <div class="text-muted small">{{ $guest->email }}</div>
                                                </div>

                                                <span class="theme-event-lib-status">
                                                    {{ $guest->status }}
                                                </span>
                                            </div>

                                        </div>

                                    @empty
                                        <div class="text-muted">Aucun invité</div>
                                    @endforelse

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    @endif

</div>