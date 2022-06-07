<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    @if (!Route::is(['login', 'register']))
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('img/mediclo-logo.png') }}" alt="Mediclo Logo" class="img-fluid" width="150">
      </a>
    @endif
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ms-2" id="navbarSupportedContent">

      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav col-md-4 mt-4 mt-md-0">
        @if (!Route::is('checkout'))
          <form action="#" class="w-100" role="search">
            <div class="input-group">
              <input type="search" class="form-control border-end-0" placeholder="Cari obat...">
              <button class="input-group-text bg-light border-start-0" id="search"><i
                  class="fas fa-search"></i></button>
            </div>
          </form>
        @endif
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav col-md-8">
        <div class="d-md-flex ms-md-auto text-md-end">
          <!-- Authentication Links -->
          @guest
            @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            @if (!Route::is('checkout'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('keranjang.index') }}">
                  <i class="fas fa-shopping-cart"></i>
                  <span class="d-md-none">Pesanan saya</span>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ \Str::limit(Auth::user()->name, 25) }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" id="logoutBtn">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endif
          @endguest
        </div>
      </ul>
    </div>
  </div>
</nav>
