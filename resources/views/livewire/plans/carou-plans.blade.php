<div class="carou-plans-container"
     x-data="{
        start() {
            setInterval(() => {
                $wire.next()
            }, 30000)
        }
     }"
     x-init="start()"
>

    @if(count($plans) > 0)
        @php $plan = $plans[$currentIndex]; @endphp

        <div class="carou-plans-card">

            <h2 class="carou-plans-title">{{ $plan['name'] }}</h2>

            <div class="carou-plans-price">
                ${{ $plan['price'] }}
            </div>

            <p class="carou-plans-guests">
                <i class="las la-users"></i>
                {{ $plan['max_guests'] }} invités max
            </p>

            <p class="carou-plans-guests">
                <i class="las la-image"></i>
                {{ $plan['max_picture'] }} photos max
            </p>

            <ul class="carou-plans-features">
                @foreach($plan['features'] as $feature)
                    <li><i class="las la-check"></i> {{ $feature }}</li>
                @endforeach
            </ul>

            <a href="{{ route('demandes.add', [$plan['id']]) }}" class="carou-plans-btn">
                Choisir ce plan
                <i class="las la-angle-right"></i>
            </a>

        </div>

        <!-- Controls -->
        <div class="carou-plans-controls">
            <button wire:click="prev"><i class="las la-angle-left"></i></button>
            <button wire:click="next"><i class="las la-angle-right"></i></button>
        </div>
    @endif

</div>