<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ url('/assets/images/deva-logo.png') }}" alt="" height="35"
                    class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i data-feather="menu"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home*') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('product*') ? 'active' : '' }}" href="{{ route('product-page') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cara Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>

                </ul>
                <form class="d-flex navbar-form">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
                @guest
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn register-btn nav-link">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn login-btn nav-link px-4 text-white">Login</a>
                        </li>
                    </ul>
                @endguest
                @auth
                    <ul class="navbar-nav d-none d-lg-flex">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                                Hi, {{ Auth::user()->name }}
                                <img src="{{ Auth::user()->images != null ? Storage::url(Auth::user()->images) : '/assets/images/profile/default-user-icon.png' }}"
                                    alt="Profile Picture" class="rounded-circle mr-2 profile-picture" width="45" />
                            </a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">History</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <div class="dropdown-driver"></div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"
                                    class="dropdown-item">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>

                    <!-- Mobile Menu -->
                    <ul class="navbar-nav d-block d-lg-none">
                        <li class="nav-item">
                            <a href="" class="nav-link"> Hi, {{ Auth::user()->name }} </a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
</div>
