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

    @if (auth()->user()->hasRole('admin'))
        @livewire('request.admin-request')
    @else
        @livewire('request.user-requests')
    @endif


    
@endsection