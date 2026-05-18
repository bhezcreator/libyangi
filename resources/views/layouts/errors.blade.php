<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Libyangi') }} - @yield('title')</title>
    <meta name="description" content="Libyangi est une application de gestion des événements et invitations : fête de mariage, fête d'anniversaire, reunion, baptêmes, soirées privées, et bien plus encore."> 
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/error.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
</head>
<body>
    <div class="error-wrapper">

        <div class="logo">
            <span class="text-logo">LIBYANGI</span>
        </div>

        <h1>@yield('code') - @yield('message')</h1>

        <p>@yield('description')</p>

        <a href="{{ url()->previous() }}" class="button"><i class="la la-arrow-left"></i> Retour à l'accueil</a>
    </div>
</body>
</html>