<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Libyangi est une application de gestion des événements et invitations : fête de mariage, fête d'anniversaire, reunion, baptêmes, soirées privées, et bien plus encore."> 
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
    <title>Invitation</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400;500&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Stalemate&family=Train+One&display=swap");
        
        :root {
            --scroll-bg: #9564ff0c;
            --scroll-thumb: #c6b2ef;
            --primary: #9564ff;
            --secondary: #c6b2ef;
            --accent: #f97316;
            --color-badge: red;
            --primary-light: #a855f7;
            --theme-event-lib-bg: #f8fafc;
            --theme-event-lib-card: #ffffff;
            --theme-event-lib-text: #1e293b;
            --theme-event-lib-text1: #f2f2f4;
            --theme-event-lib-border: #e2e8f0;
            --theme-event-lib-success: #00c548;

            --theme-event-lib-radius: 24px;
            --theme-event-lib-transition: 0.35s ease;

            --font-base: "Cormorant Garamond", Arial, Helvetica, sans-serif;
            --font-secondary: "Helvetica", Arial, sans-serif;
            --font-styler: "Dancing Script", cursive;

            --muted: #768292;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.123);
            --shadow-soft: 0 6px 15px rgba(0, 0, 0, 0.041);
            --shadow-soft-top: 0 -6px 15px rgba(0, 0, 0, 0.041);
        }

        *{
            box-sizing:border-box;
        }

        body, html{
            margin: 0;
            padding: 0;
            list-style-type: none;
            text-decoration: none;
        }

        body{
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            padding: 10px;
        }

        .cadre{
            width: 100vw;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            padding: 10px;
            background-image: url("../images/event01.svg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .imgcode img{
            width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="cadre">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, rem porro commodi quod dolor quam consequatur autem quos,
            harum voluptates explicabo sequi itaque! Soluta laborum accusamus asperiores aut ad cumque.
        </p>
 <img src="{{ public_path('images/event02.svg') }}" alt="QR Code">

        <div class="imgcode">
            <img src="{{ $qrcode }}" alt="QR Code">
        </div>
    </div>
</body>
</html>