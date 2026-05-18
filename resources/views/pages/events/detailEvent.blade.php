@extends('layouts.base')
@section('title', 'Détail de l\'événement')

{{-- @section('og')
    <meta property="og:title" content="{{ $event->title }}" />
    <meta property="og:image" content="{{ asset('storage/'.$event->prochette) }}" />
    <meta property="og:type" content="Invitation" /> 
    <meta property="og:description" content="{{ $event->slug }}" />
@endsection --}}

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

    @livewire('event.table-detail-event', ['id' => $id])
@endsection