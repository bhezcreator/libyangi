@extends('layouts.auth')

@section('content')

<form class="form" method="POST" action="{{ route('password.update') }}">
    @csrf

    <div class="logo-img">
        <img src="{{ asset('images/logo libyangi mobile.jpg') }}" alt="logo" />
    </div>

    <h2>Nouveau mot de passe</h2>

    <p class="subtitle">
        Choisissez un nouveau mot de passe sécurisé.
    </p>

    {{-- Token hidden --}}
    <input type="hidden" name="token" value="{{ $token }}">

    {{-- Email --}}
    <input
        type="email"
        name="email"
        placeholder="E-mail"
        value="{{ old('email', request()->email) }}"
        required
        autofocus
    />
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    {{-- New Password --}}
    <input
        type="password"
        name="password"
        placeholder="Nouveau mot de passe"
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
        Réinitialiser le mot de passe
    </button>

    <div class="divider">OU</div>

    <div class="links">
        <a href="{{ route('login') }}" class="switch">
            <i class="la la-arrow-left"></i> Retour à la connexion
        </a>

        <a href="{{ route('register') }}" class="switch">
            Créer un compte !
        </a>
    </div>

</form>

@endsection