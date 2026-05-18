<div class="theme-one-event-container"
     style="--primary: {{ $event->theme->message_bg_color ?? '#7c3aed' }};
            --bg: {{ $event->theme->page_bg_color ?? '#f8fafc' }};
            --text: {{ $event->theme->message_color ?? '#1e293b' }};
            --title: {{ $event->theme->title_color ?? '#111827' }};">

    {{-- HERO --}}
    <div class="theme-one-event-hero">
        <img src="{{ asset('storage/'.$event->image) }}" class="theme-one-event-cover">

        <h1 class="theme-one-event-title">
            {{ $event->title }}
        </h1>

        <div class="theme-one-event-desc">
            {!! $event->description !!}
        </div>
    </div>

    {{-- ADRESSE --}}
    @php
        $address = $event->addresses->first();
    @endphp

    @if($address)
        <div class="theme-one-event-map">
            <h3>📍 {{ $address->address }}</h3>
            <div id="map"></div>
        </div>
    @endif

    {{-- FORMULAIRE --}}
    <div class="theme-one-event-card">
        <h2>Votre message</h2>

        @if(session('success'))
            <div class="theme-one-event-alert">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="theme-one-event-form">

            <textarea wire:model="message"
                      maxlength="500"
                      placeholder="Laissez un message..."></textarea>

            <input type="text"
                   wire:model="invite"
                   placeholder="Votre nom complet">

            <div class="theme-one-event-actions">
                <label>
                    <input type="radio" wire:model="reponse" value="Accepte">
                    J'accepte
                </label>

                <label>
                    <input type="radio" wire:model="reponse" value="Refuse">
                    Je refuse
                </label>
            </div>

            <button type="submit" class="theme-one-event-btn">
                Envoyer
            </button>
        </form>
    </div>

    {{-- PRODUITS --}}
    @if($event->products->count())
        <div class="theme-one-event-products">
            <h2>Préférences</h2>

            @foreach($event->products->groupBy('category') as $category => $items)
                <div class="theme-one-event-category">
                    <h4>{{ $category }}</h4>

                    @foreach($items as $product)
                        <label>
                            <input type="checkbox" wire:model="produits" value="{{ $product->id }}">
                            {{ $product->name }}
                        </label>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
</div>