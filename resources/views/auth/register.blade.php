@extends('layouts.auth')
@section('content')

    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="logo-img">
            <img src="{{ asset('images/logo libyangi mobile.jpg') }}" alt="logo" />
        </div>

        <h2>Créer un compte</h2>

        {{-- Name --}}
        <input
            type="text"
            name="name"
            placeholder="Nom complet"
            value="{{ old('name') }}"
            required
            autofocus
        />
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- Email --}}
        <input
            type="email"
            name="email"
            placeholder="E-mail"
            value="{{ old('email') }}"
            required
        />
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- Password --}}
        <input
            type="password"
            name="password"
            placeholder="Mot de passe"
            required
        />
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- Confirm Password --}}
        <input
            type="password"
            name="password_confirmation"
            placeholder="Confirmer le mot de passe"
            required
        />

        @error('password_confirmation')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <button type="submit" class="btn btn-secondary">
            S’inscrire
        </button>

        <div class="divider">OU</div>

        <a href="{{ route('login') }}" class="switch">
            J’ai déjà un compte
        </a>

    </form>

@endsection