<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
    <title>Libyangi</title>
  </head>
  <body>
    <div id="loader">
      <div class="loader-logo-img">
        <img src="images/logo libyangi mobile transp.png" alt="logo" />
      </div>
    </div>

    <div class="contenair">
      <div class="logo">
        <div class="logo-img">
          <img src="images/logo libyangi mobile.jpg" alt="logo" />
        </div>

        <h2 class="titre">LIBYANGI</h2>
      </div>

      <div class="group-actions-btn">
        <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Créer un compte !</a>
        <a href="#" class="switch">Besoin d'aide ?</a>
      </div>
    </div>

    <!-- BACKGROUND PARTICLES -->
    <script>
      window.addEventListener("load", function () {
        const loader = document.getElementById("loader");
        const content = document.getElementById("content");

        // Transition propre
        loader.style.transition = "opacity 0.5s ease";

        // On cache le loader immédiatement après chargement réel
        loader.style.opacity = "0";

        setTimeout(() => {
          loader.style.display = "none";
          content.style.display = "block";
        }, 500); // correspond à la durée de transition
      });

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