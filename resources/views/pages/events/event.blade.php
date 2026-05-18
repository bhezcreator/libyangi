@extends('layouts.base')
@section('title', 'Evénements')

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
            <span class="current">
                Evénements
            </span>
        </div>
    </div>

    @livewire('event.events-present')
    
@endsection