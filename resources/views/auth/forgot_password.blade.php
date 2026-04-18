@extends('layouts.auth')

@section('content')

    <form class="form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="logo-img">
            <img src="{{ asset('images/logo libyangi mobile.jpg') }}" alt="logo" />
        </div>

        <h2>Mot de passe oublié</h2>

        <p class="subtitle">
            Entrez votre e-mail pour recevoir un lien de réinitialisation.
        </p>

        {{-- Email --}}
        <input
            type="email"
            name="email"
            placeholder="E-mail"
            value="{{ old('email') }}"
            required
            autofocus
        />

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- Status message --}}
        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <button type="submit" class="btn  btn-secondary">
            Envoyer le lien
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