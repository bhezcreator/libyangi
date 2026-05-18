<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Libyangi est une application de gestion des événements et invitations : fête de mariage, fête d'anniversaire, reunion, baptêmes, soirées privées, et bien plus encore."> 
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <title>@yield('title', 'Libyangi')</title>
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
    </style>
</head>
<body>
{{--      @livewire('theme-event-lib.show-event', [
        'slug' => $slug
    ]) --}}

    @livewire('theme-event-lib.show-invite-mar', [
        'slug' => $slug
    ])
    
    @livewireScripts
</body>
</html>