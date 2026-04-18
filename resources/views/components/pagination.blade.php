@props(['paginator'])

@if ($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator && $paginator->hasPages())
<div class="app-pagination">

    {{-- Bouton précédent --}}
    <button
        class="app-pagination-btn"
        wire:click="previousPage"
        wire:loading.attr="disabled"
        @if ($paginator->onFirstPage()) disabled @endif
        aria-label="Page précédente"
    >
        ‹
    </button>

    {{-- Pages --}}
    <div class="app-pagination-pages">
        @foreach ($paginator->getUrlRange(
            max(1, $paginator->currentPage() - 2),
            min($paginator->lastPage(), $paginator->currentPage() + 2)
        ) as $page => $url)

            <button
                class="app-pagination-page {{ $page == $paginator->currentPage() ? 'active' : '' }}"
                wire:click="gotoPage({{ $page }})"
                wire:loading.attr="disabled"
            >
                {{ $page }}
            </button>

        @endforeach
    </div>

    {{-- Bouton suivant --}}
    <button
        class="app-pagination-btn"
        wire:click="nextPage"
        wire:loading.attr="disabled"
        @if (! $paginator->hasMorePages()) disabled @endif
        aria-label="Page suivante"
    >
        ›
    </button>

</div>
@endif