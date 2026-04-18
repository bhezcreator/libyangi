@extends('layouts.auth')

@section('content')

    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="logo-img">
            <img src="{{ asset('images/logo libyangi mobile.jpg') }}" alt="logo" />
        </div>

        <h2>Bienvenue</h2>

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
        
        <div class="links">
            {{-- Remember me --}}
            <div class="remember">
                <label>
                    <input type="checkbox" name="remember">
                    Se souvenir de moi
                </label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="switch" style="padding-top: 5px">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-secondary">
            Se connecter
        </button>

        <div class="divider">OU</div>

        <a href="{{ route('register') }}" class="switch">
            Créer un compte !
        </a>
        
    </form>

@endsection
