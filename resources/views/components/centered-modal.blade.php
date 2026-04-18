@props([
    'title' => 'Modal',
    'width' => '300px',
])

<div 
    x-data="{ open: false }"
    x-init="$watch('$wire.showModalInterne', value => open = value)"
    x-show="open"
    x-cloak
    class="modal-interne-wrapper"
>

    <div class="modal-interne-overlay" x-transition.opacity>
        <div class="modal-interne-backdrop"></div>

        <div class="modal-interne-container"
            @click.stop
            :style="'width: {{ $width }}'"
            x-transition:enter="transition-transform duration-300"
            x-transition:enter-start="scale-90 opacity-0"
            x-transition:enter-end="scale-100 opacity-100"
            x-transition:leave="transition-transform duration-300"
            x-transition:leave-start="scale-100 opacity-100"
            x-transition:leave-end="scale-90 opacity-0"
        >
            <div class="modal-interne-header">
                <h3>{{ $title }}</h3>
                <button class="modal-interne-close" @click="$wire.showModalInterne = false">✕</button>
            </div>

            <div class="modal-interne-body">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="modal-interne-footer">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>