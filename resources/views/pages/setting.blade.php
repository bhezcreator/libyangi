@extends('layouts.base')
@section('title', 'Paramètres')

@section('content')
    <div class="page-header">
        <div class="page-title">Paramètres</div>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a> /
            <a href="javascript:void(0);" class="breadcrumb-link-disabled">Paramètres</a>
        </nav>
    </div>

    @livewire('settings-panel')

@endsection