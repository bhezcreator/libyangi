@extends('layouts.base')
@section('title', 'Notifications')

@section('content')
    <div class="page-header">
        <div class="page-title">Notifications</div>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a> /
            <a href="javascript:void(0);" class="breadcrumb-link-disabled">Notifications</a>
        </nav>
    </div>

    @livewire('user-notifications')

@endsection