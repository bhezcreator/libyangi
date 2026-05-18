@extends('layouts.base')
@section('title', 'Ajouter une demande')

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
                Demande
            </span>
        </div>
    </div>
   <livewire:request.create-request :plan="$plan" />

    
@endsection