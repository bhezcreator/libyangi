@extends('layouts.base')
@section('title', 'Utilisateurs')

@section('content')
    <div class="page-header">
        <div class="page-title">Accueil</div>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a> /
            <a href="javascript:void(0);" class="breadcrumb-link-disabled">Utilisateurs</a>
        </nav>
    </div>

    @livewire('users')

@endsection