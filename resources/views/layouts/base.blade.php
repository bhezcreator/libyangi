<!doctype html>
<html lang="fr" data-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/style-admin.css') }}">
    <title>@yield('title', 'Libyangi')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
    @livewireStyles
  </head>

  <body>
    <div id="loader">
      <div class="loader-logo-img">
        <img src="images/logo libyangi mobile transp.png" alt="logo" />
      </div>
    </div>
    <!-- ================= HEADER ================= -->
    <header>
      <div class="logo">
        <img src="images/logo libyangi mobile transp.png" alt="logo" />
      </div>

      <div class="header-right">
        <!-- NOTIFICATIONS -->
        <div class="icon-btn">
          <i class="la la-bell"></i>
          <span class="badge">3</span>
        </div>

        <!-- USER -->
        <div class="user" onclick="toggleDropdown()" title="{{ auth()->user()->name }}">
          <i class="la la-user-circle"></i>
              {{ \Illuminate\Support\Str::limit(auth()->user()->name, 5, '...') }}

          <div class="dropdown" id="dropdown">
            <a href="#" class="dropdown-a"><i class="la la-user"></i> Profil</a>
            <a href="#" class="dropdown-a"><i class="la la-cog"></i> Paramètres</a>
            <a href="#" class="dropdown-a">
              <form method="POST" action="{{ route('logout') }}" style="display:inline">
                  @csrf
                  <button type="submit" 
                    class="icon-btns" 
                    title="Se déconnecter" 
                    style="border:none;background:transparent;margin:0;padding:0;cursor:pointer;">
                    <i class="la la-sign-out"></i> Déconnexion
                  </button>
              </form>
            </a>
          </div>
        </div>

        <!-- MODE -->
        <button class="btn" onclick="toggleTheme()">
          <i id="theme-icon" class="la la-moon"></i>
        </button>
      </div>
    </header>

    <!-- ================= CONTENT ================= -->
    @yield('content')

    <!-- ================= BOTTOM NAV ================= -->
     @include('partials.nav')

      @livewireScripts
    <script src="script.js"></script>
  </body>
</html>
