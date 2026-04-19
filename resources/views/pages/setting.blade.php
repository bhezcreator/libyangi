@extends('layouts.base')
@section('title', 'Paramètres')

@section('content')

    <div class="breadcrumb">
        <h3>
            <i class="la la-cog"></i> Paramètres
        </h3>

        <div class="breadcrumbs">
                <a href="{{ route('home') }}">
                <i class="las la-home"></i>
                <span>Accueil</span>
            </a>

            <span class="separator">/</span>
            <span class="current">
                Paramètres
            </span>
        </div>
    </div>

    @livewire('table-setting')
@endsection