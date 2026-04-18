<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Libyangi</title>
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
    <style>
        :root {
            --bg1: #0f0f1a;
            --bg2: #1a1a2e;
            --glass: rgba(255, 255, 255, 0.08);
            --text: #f2f2f4;

            --primary: #9564ff;
            --secondary: #c6b2ef;
            --accent: #f97316;

            --bg: #1b2a4e;
            --text-nav: #f2f2f4;
            --muted: #94a3b8;

            --radius: 14px;
        }

        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            margin: 0;
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;

            /* Background gradient moderne */
            background: linear-gradient(-45deg, var(--bg1), var(--bg2), var(--bg));
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .error-wrapper {
            background: var(--glass);
            backdrop-filter: blur(12px);
            width: 100%;
            max-width: 480px;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: 0 15px 40px rgba(0,0,0,.3);
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
        }

        /* Logo */
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .logo .text-logo {
            font-style: italic;
            font-weight: 900;
            font-size: 2rem;
            color: var(--primary);
            padding: 10px 20px;
            border: 1px solid var(--primary);
            border-radius: 20px 0 20px 0;
        }

        .logo .text-logo-orange {
            color: var(--accent);
        }

        /* Text */
        h1 {
            font-size: 2rem;
            margin-bottom: .5rem;
            color: var(--text);
        }

        p {
            font-size: 1rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
        }

        /* Button */
        a.button {
            display: inline-block;
            padding: .85rem 1.5rem;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: .3s;
        }

        a.button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,.3);
        }

        /* Responsive */
        @media(max-width:480px){
            .error-wrapper {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-wrapper">

        <div class="logo">
            <span class="text-logo">LIBYANGI</span>
        </div>

        <h1>@yield('code') - @yield('message')</h1>

        <p>@yield('description')</p>

        <a href="{{ url('/') }}" class="button"><i class="la la-arrow-left"></i> Retour à l'accueil</a>

    </div>
</body>
</html>