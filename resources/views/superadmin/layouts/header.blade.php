<header class="main-navbar">
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/">
    <img class="header-logo" src="{{ asset('assets/admin-theme/images/global/header-logo.svg') }}">
  </a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="/"></a>
      </li>
    </ul>
    <div class="">
      <div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="header-exit-link">
          <img src="{{ asset('assets/admin-theme/images/global/exit.svg') }}"> Sair
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</nav>
<nav class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-link active nav-link-tab" id="main-menu-tab" data-toggle="tab" href="#main-menu" role="tab" aria-controls="main-menu" aria-selected="true">
          <img class="tab-link-icon-1" src="assets/admin-theme/images/restaurant/home/menu-icon.svg">
          Adicionar menu
      </a>
      <a class="nav-link nav-link-tab" id="graph-menu-tab" data-toggle="tab" href="#main-graph" role="tab" aria-controls="main-graph" aria-selected="false">
          <img class="tab-link-icon-2" src="assets/admin-theme/images/restaurant/home/graph-icon.svg">
          Relatório
      </a>
      <a class="nav-link nav-link-tab" id="user-menu-tab" data-toggle="tab" href="#user-graph" role="tab" aria-controls="user-graph" aria-selected="false">
          <img class="tab-link-icon-2" src="assets/admin-theme/images/restaurant/home/graph-icon.svg">
          Novo usuário
      </a>
    </nav>
</header>