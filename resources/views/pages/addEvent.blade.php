@extends('layouts.base')
@section('title', 'Ajouter un événement')

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
            <a href="{{ route('events') }}">
                <span>Evénements</span>
            </a>

            <span class="separator">/</span>
            <span class="current">
                Evénement
            </span>
        </div>
    </div>

    
@endsection