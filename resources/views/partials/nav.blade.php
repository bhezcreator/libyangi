<div class="bottom-nav">
  <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
    <i class="la la-home"></i>
    <span>Accueil</span>
  </a>

  <a href="{{ route('events') }}" class="nav-item {{ request()->routeIs('events') ? 'active' : '' }}">
    <i class="la la-calendar"></i>
    <span>Evénements</span>
  </a>

  <a href="{{ route('demandes') }}" class="nav-item {{ request()->routeIs('demandes') ? 'active' : '' }}">
    <i class="la la-hourglass-half"></i> 
    <span>Demandes</span>
  </a>

  <a href="{{ route('validations') }}" class="nav-item {{ request()->routeIs('validations') ? 'active' : '' }}">
    <i class="la la-check-circle"></i>
    <span>Validations</span>
  </a>

  <a href="{{ route('notifications') }}" class="nav-item {{ request()->routeIs('notifications') ? 'active' : '' }}">
    <i class="la la-bell"></i>
    <span>Notifications</span>
  </a>

  <a href="{{ route('settings') }}" class="nav-item {{ request()->routeIs('settings') ? 'active' : '' }}">
    <i class="la la-cog"></i>
    <span>Paramètres</span>
  </a>
</div>