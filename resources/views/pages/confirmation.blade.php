<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Libyangi est une application de gestion des événements et invitations : fête de mariage, fête d'anniversaire, reunion, baptêmes, soirées privées, et bien plus encore."> 
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
    <title>Libyangi - Confirmation de l'invitation</title>
        <style>
            @charset "UTF-8";
            html,
            body,
            div,
            span,
            applet,
            object,
            iframe,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            blockquote,
            pre,
            a,
            abbr,
            acronym,
            address,
            big,
            cite,
            code,
            del,
            dfn,
            em,
            img,
            ins,
            kbd,
            q,
            s,
            samp,
            small,
            strike,
            strong,
            sub,
            sup,
            tt,
            var,
            b,
            u,
            i,
            center,
            dl,
            dt,
            dd,
            ol,
            ul,
            li,
            fieldset,
            form,
            label,
            legend,
            table,
            caption,
            tbody,
            tfoot,
            thead,
            tr,
            th,
            td,
            article,
            aside,
            canvas,
            details,
            embed,
            figure,
            figcaption,
            footer,
            header,
            hgroup,
            menu,
            nav,
            output,
            ruby,
            section,
            summary,
            time,
            mark,
            audio,
            video {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 100%;
                vertical-align: baseline;
            }
            article,
            aside,
            details,
            figcaption,
            figure,
            footer,
            header,
            hgroup,
            menu,
            nav,
            section {
                display: block;
            }
            body {
                line-height: 1;
            }
            ol,
            ul {
                list-style: none;
            }
            blockquote,
            q {
                quotes: none;
            }
            blockquote:before,
            blockquote:after,
            q:before,
            q:after {
                content: "";
                content: none;
            }
            table {
                border-collapse: collapse;
                border-spacing: 0;
            }

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

            html {
                scroll-behavior: smooth;
                -webkit-text-size-adjust: 100%;
                font-family: "Arial";
            }

            /* ===== Gestion de barre defilement sur Chrome, Edge, Safari ===== */
            ::-webkit-scrollbar {
                width: 5px;
                height: 5px;
            }

            ::-webkit-scrollbar-track {
                background: var(--scroll-bg);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                background: var(--scroll-thumb);
                border-radius: 10px;
                border: 1px solid var(--scroll-bg);
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--primary);
            }

            /* ===== Firefox ===== */
            * {
                scrollbar-width: thin;
                scrollbar-color: var(--scroll-thumb) var(--scroll-bg);
            }

            /* ***************************** 
                MSG EVENT 
                *********************** */
            .msg-fin-event-container {
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                box-sizing: border-box;
            }

            .msg-fin-event-card {
                width: 100%;
                max-width: 650px;
                background: var(--theme-event-lib-card);
                border-radius: var(--theme-event-lib-radius);
                padding: 35px 30px;
                box-shadow: var(--shadow-soft);
                border: 1px solid var(--theme-event-lib-border);

                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 25px;

                position: relative;
                overflow: hidden;

                transition: var(--theme-event-lib-transition);
            }

            .msg-fin-event-card::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;

                width: 6px;
                height: 100%;

                background: linear-gradient(
                    to bottom,
                    var(--primary),
                    var(--primary-light)
                );
            }

            .msg-fin-event-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow);
            }

            .msg-fin-event-icon {
                min-width: 90px;
                width: 90px;
                height: 90px;
                border-radius: 50%;
                background: var(--accent);
                display: flex;
                align-items: center;
                justify-content: center;

                box-shadow: 0 10px 25px rgba(149, 100, 255, 0.25);
            }

            .msg-fin-event-icon i {
                font-size: 42px;
                color: var(--theme-event-lib-text1);
            }

            .msg-fin-event-content {
                flex: 1;
            }

            .msg-fin-event-title {
                margin: 0 0 12px;
                text-align: center;
                font-size: 28px;
                font-weight: 700;
                color: var(--theme-event-lib-text);
                font-family: var(--font-base);
            }

            .msg-fin-event-text {
                text-align: center;
                margin: 0;
                font-size: 16px;
                line-height: 1.7;
                color: var(--muted);
                font-family: var(--font-base);
            }

            .msg-fin-event-btn {
                margin-top: 22px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                text-decoration: none;
                text-align: center !important;
                background: linear-gradient(135deg, var(--primary), var(--primary-light));
                color: var(--theme-event-lib-text1);
                padding: 14px 22px;
                border-radius: 14px;
                font-size: 15px;
                font-weight: 600;
                width: 100%;
                transition: var(--theme-event-lib-transition);
                box-shadow: 0 10px 20px rgba(149, 100, 255, 0.2);
            }

            .msg-fin-event-btn:hover {
                transform: translateY(-2px);
                opacity: 0.95;
            }

            .msg-fin-event-btn i {
                font-size: 18px;
            }

            .msg-fin-event-btn.btn-retour {
                background: linear-gradient(135deg, var(--accent), var(--primary-light));
            }

            /* Responsive */
            @media screen and (max-width: 768px) {
                .msg-fin-event-card {
                    max-width: 95%;
                    flex-direction: column;
                    align-content: center;
                    text-align: center;
                    padding: 30px 22px;
                }

                .msg-fin-event-icon {
                    width: 75px;
                    height: 75px;
                    min-width: 75px;
                }

                .msg-fin-event-icon i {
                    font-size: 34px;
                }

                .msg-fin-event-title {
                    font-size: 24px;
                }

                .msg-fin-event-text {
                    font-size: 15px;
                }

                .msg-fin-event-btn {
                    width: 100%;
                    justify-content: center;
                }
            }

            /* Partie bas de l'invitation */
            .bas_invitation {
                display: flex;
                justify-content: center;
                align-content: center;
                flex-direction: column;
                gap: 10px;
                width: 100%;
                font-size: 14px;
                margin-top: 10px;
            }

            .bas_invitation p {
                color: var(--muted);
                text-align: center;
                font-style: italic;
            }

            .bas_invitation a {
                text-align: center;
                text-decoration: none;
                font-style: italic;
            }

            /* =========================
                LOADING SCREEN
                ======================== */
            .invitation-loader {
                position: fixed;
                inset: 0;
                width: 100%;
                height: 100vh;
                z-index: 999999;
                overflow: hidden;

                display: flex;
                align-items: center;
                justify-content: center;

                background: linear-gradient(
                    135deg,
                    #0f172a 0%,
                    #1e1b4b 25%,
                    #6d28d9 60%,
                    #9564ff 100%
                );

                transition:
                    opacity 1s ease,
                    visibility 1s ease;
            }

            .invitation-loader.hidden {
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
            }

            /*  =========================
                BACKGROUND ANIMATION
                ========================= */
            .animated-bg {
                position: absolute;
                inset: 0;
                overflow: hidden;
            }

            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(70px);
                opacity: 0.45;
                animation: float 15s infinite ease-in-out alternate;
            }

            .blob:nth-child(1) {
                width: 400px;
                height: 400px;
                background: #a855f7;
                top: -100px;
                left: -100px;
            }

            .blob:nth-child(2) {
                width: 500px;
                height: 500px;
                background: #9333ea;
                bottom: -150px;
                right: -100px;
                animation-duration: 18s;
            }

            .blob:nth-child(3) {
                width: 300px;
                height: 300px;
                background: #f97316;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                animation-duration: 20s;
            }

            @keyframes float {
                0% {
                    transform: translateY(0) translateX(0) scale(1);
                }
                100% {
                    transform: translateY(-40px) translateX(40px) scale(1.2);
                }
            }

            /*  =========================
                CENTER CONTENT
                ========================= */
            .loader-content {
                position: relative;
                z-index: 10;
                text-align: center;
                color: white;
            }

            /* Outer pulse */
            .pulse-ring {
                position: relative;
                width: 180px;
                height: 180px;
                margin: auto;

                display: flex;
                align-items: center;
                justify-content: center;
            }

            .pulse-ring::before,
            .pulse-ring::after {
                content: "";
                position: absolute;
                inset: 0;
                border-radius: 50%;
                border: 2px solid rgba(255, 255, 255, 0.15);
                animation: pulse 2.5s linear infinite;
            }

            .pulse-ring::after {
                animation-delay: 1.2s;
            }

            @keyframes pulse {
                0% {
                    transform: scale(0.8);
                    opacity: 0;
                }

                50% {
                    opacity: 1;
                }

                100% {
                    transform: scale(1.4);
                    opacity: 0;
                }
            }

            /* Main Circle */
            .loader-circle {
                width: 130px;
                height: 130px;
                border-radius: 50%;

                display: flex;
                justify-content: center;
                align-items: center;

                background: rgba(255, 255, 255, 0.12);
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.15);

                box-shadow:
                    0 0 30px rgba(149, 100, 255, 0.5),
                    0 0 80px rgba(149, 100, 255, 0.3),
                    inset 0 0 15px rgba(255, 255, 255, 0.1);

                animation: heartbeat 1.5s infinite ease-in-out;
            }

            @keyframes heartbeat {
                0%,
                100% {
                    transform: scale(1);
                }

                25% {
                    transform: scale(1.08);
                }

                50% {
                    transform: scale(0.96);
                }

                75% {
                    transform: scale(1.05);
                }
            }

            .loader-circle i {
                font-size: 4rem;
                color: white;
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.6);
            }

            .loader-title {
                margin-top: 40px;
                font-size: 2rem;
                font-weight: 700;
                letter-spacing: 0.5px;
            }

            .loader-onetitle {
                margin-bottom: 40px;
                font-size: 1.8rem;
                color: rgba(255, 255, 255, 0.75);
            }

            .loader-subtitle {
                margin-top: 10px;
                font-size: 1rem;
                color: rgba(255, 255, 255, 0.75);
            }

            /*  =========================
                DOTS
                ========================= */
            .loading-dots {
                margin-top: 35px;
                display: flex;
                justify-content: center;
                gap: 10px;
            }

            .loading-dots span {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: white;
                opacity: 0.3;
                animation: blink 1.4s infinite;
            }

            .loading-dots span:nth-child(2) {
                animation-delay: 0.2s;
            }

            .loading-dots span:nth-child(3) {
                animation-delay: 0.4s;
            }

            .loading-dots span:nth-child(4) {
                animation-delay: 0.6s;
            }

            @keyframes blink {
                0%,
                100% {
                    opacity: 0.3;
                    transform: translateY(0);
                }

                50% {
                    opacity: 1;
                    transform: translateY(-6px);
                }
            }

            /*  =========================
                SHIMMER EFFECT
                ========================= */
            .light-wave {
                position: absolute;
                width: 200%;
                height: 200%;
                background: linear-gradient(
                    120deg,
                    transparent 20%,
                    rgba(255, 255, 255, 0.08) 50%,
                    transparent 80%
                );

                animation: wave 8s linear infinite;
                transform: rotate(25deg);
            }

            @keyframes wave {
                0% {
                    transform: translateX(-50%) rotate(25deg);
                }

                100% {
                    transform: translateX(50%) rotate(25deg);
                }
            }

            /*  ==================================
                FLOATING PARTICLES (TOP → BOTTOM)
                ================================== */
            .particle {
                position: absolute;
                width: 10px;
                height: 10px;
                background: var(--primary-light);
                border-radius: 0 50% 0;
                opacity: 0.4;
                animation: floatDown 10s linear infinite;
            }

            @keyframes floatDown {
                0% {
                    transform: translateY(-10vh) translateX(0) scale(0);
                    opacity: 0;
                }
                50% {
                    transform: translateY(50vh) translateX(20px);
                    opacity: 1;
                }
                100% {
                    transform: translateY(100vh) translateX(-20px) scale(1);
                    opacity: 0;
                }
            }
        </style>
</head>
<body>
    <!-- LOADING -->
    <div class="invitation-loader" id="loader" wire:ignore>

        <div class="animated-bg">
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>

            <div class="light-wave"></div>
        </div>

        <div class="loader-content">

            <p class="loader-onetitle">
                Invitation
            </p>

            <div class="pulse-ring">
                <div class="loader-circle">
                    <i class="las la-heart"></i>
                </div>
            </div>

            <h1 class="loader-title">
                Confirmation de l'invitation.
            </h1>

            <p class="loader-subtitle">
                Veuillez patienter quelques instants
            </p>

            <div class="loading-dots">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>

    <div class="msg-fin-event-container">
        
        <div class="msg-fin-event-card">

            <div class="msg-fin-event-icon">
                <i class="las la-check"></i>
            </div>

            <div class="msg-fin-event-content">
                <h2 class="msg-fin-event-title">
                    Confirmation de l'invitation
                </h2>

                <p class="msg-fin-event-text">
                    Merci d'avoir confirmer votre participation Mr., Mm., Couple, <strong>{{ $invite }}</strong>
                </p>

                <a href="{{ route('events.download', [$chemin,$invite,$event]) }}"  class="msg-fin-event-btn">Télécharger l'invitation PDF <i class="las la-download"></i></a>

                <a href="/" class="msg-fin-event-btn btn-retour">
                    Aller à la page d'accueil
                    <i class="las la-arrow-right"></i>
                </a>
            </div>

            <div class="bas_invitation">
                <p>Invitation réaliser par <strong>libyangi</strong>, pour savoir plus,</p>
                
                @php
                    $message = bin2hex("Bonjour, j'aimerais avoir plus d'informations sur votre service.");
                    $whatsappUrl = "https://wa.me/243827431252?text=" . urlencode($message);
                @endphp

                <a href="{{ $whatsappUrl }}" target="_black">
                    <i class="las la-arrow-right"></i> 
                    Contactez-nous sur Whatsapp
                </a>
            </div>

        </div>

    </div>

    <!--
        ==========================================
        LOADING PROFESSIONNEL
        ==========================================
        - Attend que la page soit complètement chargée
        - Garde le loader minimum 20 secondes
        - Puis fade out smooth
    -->
    <script>
        window.addEventListener("load", () => {
            const loader = document.getElementById("loader");
            const minimumLoadingTime = 10000; // 10 sec
            setTimeout(() => {
                loader.classList.add("hidden");
            }, minimumLoadingTime);
        });
    </script>    

    <!-- ANIMATION : FEUILLES QUI TOMBENT -->
    <script>
        for (let i = 0; i < 25; i++) {
            let p = document.createElement("div");
            p.className = "particle";

            p.style.left = Math.random() * 100 + "vw";
            p.style.top = "-10vh"; // démarre en haut

            p.style.animationDuration = 5 + Math.random() * 10 + "s";

            document.body.appendChild(p);
        }
    </script>
</body>
</html>