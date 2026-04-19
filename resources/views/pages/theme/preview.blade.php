<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Preview Thème</title>

    <style>
        body {
            background-color: {{ $theme->page_bg_color }};
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            padding: 20px;
            border-radius: 10px;

            background-color: {{ $theme->message_bg_color }};
            color: {{ $theme->message_color }};

            @if($theme->border_style == 'Simple')
                border: 2px solid black;
            @elseif($theme->border_style == 'Double')
                border: 4px double black;
            @elseif($theme->border_style == 'Pointiller')
                border: 2px dashed black;
            @else
                border: none;
            @endif

            text-align: center;
        }

        .title {
            color: {{ $theme->title_color }};
            font-size: 24px;
            margin-bottom: 10px;
        }

        .image {
            margin-top: 15px;
        }

        .image img {
            max-width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <div class="card">

        <div class="title">
            🎉 {{ $theme->title }}
        </div>

        <p>
            Vous êtes invité à notre événement spécial.
        </p>

        @if($theme->message_image)
            <div class="image">
                <img src="{{ asset('storage/'.$theme->message_image) }}">
            </div>
        @endif

    </div>

</body>
</html>