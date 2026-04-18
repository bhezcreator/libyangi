@extends('layouts.base')
@section('title', 'Organisations')

@section('content')
    <div class="page-header">
        <div class="page-title">Organisations</div>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a> /
            <a href="javascript:void(0);" class="breadcrumb-link-disabled">Organisations</a>
        </nav>
    </div>

    @livewire('organisations')
    
    @endsection