@props([
    'title' => 'Confirmation',
    'message' => 'Êtes-vous sûr ?',
    'confirmText' => 'Confirmer',
    'cancelText' => 'Annuler',
    'width' => '400px',
])

<div 
    x-data="{ open: false }"
    x-init="$watch('$wire.confirmingDelete', value => open = value)"
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

            <!-- Header -->
            <div class="modal-interne-header">
                <h3>{{ $title }}</h3>
                <button 
                    class="modal-interne-close" 
                    @click="$wire.confirmingDelete = false"
                >
                    ✕
                </button>
            </div>

            <!-- Body -->
            <div class="modal-interne-body confirm-body">
                <div class="confirm-icon">⚠️</div>
                <p class="confirm-message">{{ $message }}</p>
            </div>

            <!-- Footer -->
            <div class="modal-interne-footer">
                <button
                    class="btn-confirm btn-outline"
                    @click="$wire.confirmingDelete = false"
                >
                    {{ $cancelText }}
                </button>

                <button
                    class="btn-confirm btn-danger"
                    wire:click="confirm"
                >
                    {{ $confirmText }}
                </button>
            </div>

        </div>
    </div>
</div>