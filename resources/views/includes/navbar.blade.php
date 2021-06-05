<nav
    class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
    data-aos="fade-down"
>
    <div class="container">
    <a href="{{ route('home') }}" class="navbar-brand">
        <img src="/images/CM 1.png" alt="Logo" />
    </a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories') }}" class="nav-link">Layanan</a>
            </li>
            @guest
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a
                    href="{{  route('login') }}"
                    class="btn btn-success nav-link px-4 text-white"
                    >Sign In</a
                    >
                </li>
            @endguest
          </ul>
        @auth
         <!-- Desktop Menu -->
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
              >
                <img
                  src="/images/icon-user.png"
                  alt=""
                  class="rounded-circle mr-2 profile-picture"
                />
                Whatsapp, {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('dashboard') }}">Dasbor</a>
                <a class="dropdown-item" href="{{ route('dashboard-settings-account') }}"
                  >Pengaturan</a
                >
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Logout
                            </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
              </div>
            </li>
            <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                        @php
                            $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                        @endphp
                        @if($carts > 0)
                            <img src="/images/icon-cart-emptys.svg" alt="" />
                            <div class="card-badge">{{ $carts }}</div>
                        @else
                            <img src="/images/icon-cart-emptys.svg" alt="" />
                        @endif
                    </a>
                </li>
            </ul>

          <!-- Mobile Menu -->
          <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
              <a class="nav-link" href="#"> Whatsapp, Aydan! </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-inline-block" href="#"> Keranjang </a>
            </li>
          </ul>
        @endauth

        </div>
      </div>
    </nav>