@extends('layouts.base')
@section('title', 'Tableau de bord')

@section('content')

    @if (Auth::user()->getRoleNames()->first() !== 'admin')
        @livewire('plans.carou-plans')
    @else
        
    @endif

    @livewire('event.stat-admin-event')
@endsection