@extends('layouts.base')
@section('title', 'Demandes')

@section('content')

    <div class="breadcrumb">
        <h3>
            <i class="la la-hourglass-half"></i> Demandes
        </h3>

        <div class="breadcrumbs">
            <a href="{{ route('home') }}">
                <i class="las la-home"></i>
                <span> Accueil</span>
            </a>

            <span class="separator">/</span>
            <span class="current">
                Demandes
            </span>
        </div>
    </div>

    @livewire('request.user-requests')
    
@endsection