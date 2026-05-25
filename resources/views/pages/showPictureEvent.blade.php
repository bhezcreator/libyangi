<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Libyangi est une application de gestion des événements et invitations : fête de mariage, fête d'anniversaire, reunion, baptêmes, soirées privées, et bien plus encore."> 
        <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
        <title>Libyangi - Médias</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
        @livewireStyles
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

            :root {
                --scroll-bg: #9564ff0c;
                --scroll-thumb: #c6b2ef;
                --color-primary: #9564ff;
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
                background: var(--color-primary);
            }

            /* ===== Firefox ===== */
            * {
                scrollbar-width: thin;
                scrollbar-color: var(--scroll-thumb) var(--scroll-bg);
            }


/* =========================
   THEME
========================= */
:root {
    --primary: #9564ff;
    --secondary: #c6b2ef;
    --accent: #f97316;

    --bg: #1b2a4e;
    --card: rgba(17, 28, 54, 0.75);
    --text: #f2f2f4;
    --text-nav: #f2f2f4;
    --muted: #94a3b8;

    /* Tailles */
    --header-height: 65px;
    --sidebar-width-collapsed: 60px;
    --sidebar-width-expanded: 200px;
    --icon-size: 1.4rem;
    --icon-size-mobile: 1.2rem;
    --font-base: Arial, Helvetica, sans-serif;

    --border: rgba(0, 0, 0, 0.3);

    --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    --shadow-soft: 0 6px 15px rgba(0, 0, 0, 0.041);
    --shadow-soft-top: 0 -6px 15px rgba(0, 0, 0, 0.041);
}

[data-theme="light"] {
    --bg: #f2f2f4;
    --card: rgba(255, 255, 255, 0.85);
    --text: #0f172a;
    --muted: #64748b;
    --border: rgba(0, 0, 0, 0.08);
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.041);
}

/* =========================
   GLOBAL
========================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: system-ui, sans-serif;
}

/* Loader plein écran */
#loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: var(--bg);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Logo */
.loader-logo-img img {
    width: 60px;
    height: 60px;
    object-fit: contain;
    animation: spinBounce 2s infinite ease-in-out;
}

/* Animation rotation + mouvement vertical */
@keyframes spinBounce {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    25% {
        transform: translateY(-30px) rotate(90deg);
    }
    50% {
        transform: translateY(0) rotate(180deg);
    }
    75% {
        transform: translateY(30px) rotate(270deg);
    }
    100% {
        transform: translateY(0) rotate(360deg);
    }
}

body {
    background: var(--bg);
    color: var(--text);
    transition: 0.3s ease;
    height: 100vh;
    overflow-y: hidden;
}

/* =========================
   HEADER (glass effect)
========================= */
header {
    height: var(--header-height);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;

    position: sticky;
    top: 0;
    z-index: 100;

    background: var(--card);
    backdrop-filter: blur(12px);

    border-bottom: 1px solid var(--border);
    box-shadow: var(--shadow-soft);
}

.logo img {
    width: auto;
    height: 50px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 14px;
}

/* =========================
    CONTENT
========================= */
.container {
    padding: 20px 20px 100px 20px;
    height: calc(100vh - var(--header-height));
    overflow-y: auto;
}

            
/* =========================================================
    PHOTO EVENT
========================================================= */

.photo-event {
    width: 100%;
    color: var(--text);
}

/* =========================================================
    HEADER
========================================================= */

.photo-event__header {
    margin-bottom: 25px;
}

.photo-event__header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.photo-event__title {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
    color: var(--text);
}

.photo-event__subtitle {
    margin-top: 6px;
    color: var(--muted);
    font-size: 14px;
}

/* =========================================================
    ACTIONS
========================================================= */

.photo-event__actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.photo-event__search {
    width: 260px;
    height: 48px;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 0 16px;
    outline: none;

    background: rgba(255, 255, 255, 0.06);
    color: var(--primary);

    transition: 0.3s;
    backdrop-filter: blur(10px);
}

.photo-event__search::placeholder {
    color: var(--muted);
}

.photo-event__search:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(149, 100, 255, 0.2);
}

.photo-event__add-btn {
    height: 48px;
    padding: 0 20px;
    border: none;
    border-radius: 16px;

    background: linear-gradient(135deg, var(--primary), #7c3aed);

    color: #fff;
    cursor: pointer;

    display: flex;
    align-items: center;
    gap: 10px;

    font-weight: 600;

    transition: 0.3s;

    box-shadow: var(--shadow-soft);
}

.photo-event__add-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

/* =========================================================
    GRID
========================================================= */

.photo-event__grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 22px;
}

/* =========================================================
    CARD ITEM
========================================================= */

.photo-event__item {
    background: var(--card);

    border: 1px solid rgba(255, 255, 255, 0.06);

    border-radius: 24px;

    overflow: hidden;

    box-shadow: var(--shadow-soft);

    transition: 0.35s ease;

    backdrop-filter: blur(14px);
}

.photo-event__item:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow);
}

/* =========================================================
    IMAGE
========================================================= */

.photo-event__image-wrapper {
    position: relative;
    overflow: hidden;
}

.photo-event__image {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
}

/* =========================================================
    OVERLAY
========================================================= */

.photo-event__overlay {
    position: absolute;
    inset: 0;

    background: rgba(0, 0, 0, 0.55);

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;

    opacity: 0;

    transition: 0.3s;
}

.photo-event__image-wrapper:hover .photo-event__overlay {
    opacity: 1;
}

/* =========================================================
    BUTTONS
========================================================= */

.photo-event__icon-btn {
    width: 46px;
    height: 46px;

    border: none;
    border-radius: 14px;

    color: #fff;
    cursor: pointer;

    font-size: 18px;

    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: 0.3s;
}

.photo-event__icon-btn:hover {
    transform: scale(1.08);
}

.photo-event__icon-btn--edit {
    background: linear-gradient(135deg, #f59e0b, #f97316);
}

.photo-event__icon-btn--delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

/* =========================================================
    CONTENT
========================================================= */

.photo-event__content {
    padding: 18px;
}

.photo-event__badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.photo-event__badge {
    padding: 8px 14px;

    border-radius: 999px;

    font-size: 13px;
    font-weight: 600;
}

.photo-event__badge--primary {
    background: rgba(149, 100, 255, 0.18);
    color: #d8c6ff;
}

.photo-event__badge--secondary {
    background: rgba(255, 255, 255, 0.08);
    color: var(--text);
}

/* =========================================================
    EMPTY
========================================================= */

.photo-event__empty {
    grid-column: 1/-1;

    background: var(--card);

    border-radius: 24px;

    padding: 70px 20px;

    text-align: center;

    border: 1px solid rgba(255, 255, 255, 0.06);

    box-shadow: var(--shadow-soft);

    backdrop-filter: blur(12px);
}

.photo-event__empty-icon {
    font-size: 65px;
    color: var(--muted);
    margin-bottom: 18px;
}

.photo-event__empty-title {
    margin: 0;

    font-size: 24px;
    font-weight: 700;

    color: var(--text);
}

.photo-event__empty-text {
    margin-top: 12px;
    color: var(--muted);
}

/* =========================================================
    LOADING
========================================================= */

.photo-event__loading {
    opacity: 0.6;
    pointer-events: none;
}

.photo-event__upload-loading {
    display: flex;
    align-items: center;
    gap: 12px;

    margin-top: 18px;

    font-size: 14px;

    color: var(--muted);
}

.photo-event__loader {
    width: 18px;
    height: 18px;

    border: 2px solid rgba(255, 255, 255, 0.15);
    border-top-color: var(--primary);

    border-radius: 50%;

    animation: photo-event-spin 0.7s linear infinite;
}

@keyframes photo-event-spin {
    to {
        transform: rotate(360deg);
    }
}

/* =========================================================
    PREVIEW GRID
========================================================= */

.photo-event__preview-grid {
    display: grid;

    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));

    gap: 15px;

    margin-top: 20px;
}

.photo-event__preview-item {
    border-radius: 16px;

    overflow: hidden;

    background: rgba(255, 255, 255, 0.04);

    border: 1px solid rgba(255, 255, 255, 0.05);

    box-shadow: var(--shadow-soft);

    transition: 0.3s;
}

.photo-event__preview-item:hover {
    transform: translateY(-4px);
}

.photo-event__preview-media {
    width: 100%;
    height: 150px;

    object-fit: cover;

    display: block;
}

/* =========================================================
    RESPONSIVE
========================================================= */

@media (max-width: 768px) {
    .photo-event__header-content {
        flex-direction: column;
        align-items: stretch;
    }

    .photo-event__actions {
        width: 100%;
    }

    .photo-event__search {
        width: 100%;
    }

    .photo-event__add-btn {
        width: 100%;
        justify-content: center;
    }

    .photo-event__grid {
        grid-template-columns: 1fr;
    }

    .photo-event__image {
        height: 220px;
    }
}
        </style>
    </head>
    <body>
        <!-- ================= HEADER ================= -->
        <header>
            <div class="logo">
                <img src="{{ asset('images/logo libyangi mobile transp.png') }}" alt="logo" />
            </div>

            <div></div>
        </header>

        <div class="container">
                @livewire('event.media-picture-public', [
                    'event_id' => $id
                ])
        </div>
        
        @livewireScripts
    </body>
</html>