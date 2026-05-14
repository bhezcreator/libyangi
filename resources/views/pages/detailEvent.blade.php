@extends('layouts.base')
@section('title', 'Détail de l\'événement')

@section('content')

    <div class="breadcrumb">
        <h3>
            <i class="la la-calendar"></i> Evénements
        </h3>

        <div class="breadcrumbs">
            <a href="{{ route('home') }}">
                <i class="las la-home"></i>
                <span>Accueil</span>
            </a>

            <span class="separator">/</span>
            <a href="{{ route('events.index') }}">
                <span>Evénements</span>
            </a>

            <span class="separator">/</span>
            <span class="current">
                Détail
            </span>
        </div>
    </div>

    @if(auth()->user()->hasRole('admin'))
        @livewire('event.detail-vue-event', ['id' => $id])
    @else
        @livewire('event.table-detail-event', ['id' => $id])
    @endif
@endsection