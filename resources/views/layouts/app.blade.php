<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @stack('prepend-style')
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Poppins:ital,wght@0,300;0,400;0,600;1,300&display=swap"
        rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('addon-style')

</head>

<body>
    <div id="app">
        <header class="border-bottom">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="{{ url('/assets/images/deva-logo.png') }}" alt="" height="35"
                                class="d-inline-block align-text-top">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Produk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Cara Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Tentag Kami</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Kontak Kami</a>
                                </li>

                            </ul>
                            <form class="d-flex navbar-form">
                                <input class="form-control me-2" type="search" placeholder="Search"
                                    aria-label="Search">
                            </form>
                            @guest
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="btn register-btn nav-link">Sign Up</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}"
                                            class="btn login-btn nav-link px-4 text-white">Login</a>
                                    </li>
                                </ul>
                            @endguest
                            @auth
                                <ul class="navbar-nav d-none d-lg-flex">
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                            data-toggle="dropdown">
                                            Hi, {{ Auth::user()->name }}
                                            <img src="{{ Auth::user()->images != null ? Storage::url(Auth::user()->images) : '/assets/images/profile/default-user-icon.png' }}"
                                                alt="Profile Picture" class="rounded-circle mr-2 profile-picture"
                                                width="45" />
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">History</a>
                                            <a href="#" class="dropdown-item">Settings</a>
                                            <div class="dropdown-driver"></div>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                                                class="dropdown-item">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
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
        </header>

        {{-- <header class="p-3 mb-3 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                         <img src="{{ url('/assets/images/deva.png') }}" alt="Logo" class="img-fluid" width="30" height="24">
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">Products</a></li>
                    </ul>

                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>

                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32"
                                height="32">
                            {{ Auth::user()->name }} John
                        </a>
                        <ul class="dropdown-menu text-small" style="">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </header> --}}

        <main class="">
            @yield('content')
        </main>


        <footer class="container-fluid mt-5">
            <div class="card bg-white mx-5">
                <div class="row mb-4">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="footer-text pull-left">
                            <div class="d-flex">
                                <h1 class="font-weight-bold mr-2 px-3" style="color:white; background-color:#957bda"> T
                                </h1>
                                <h1 style="color: #957bda">Devs</h1>
                            </div>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi non
                                pariatur numquam animi nam at impedit odit nisi.</p>
                            <div class="social mt-2 mb-3"> <i class="fa fa-facebook-official fa-lg"></i> <i
                                    class="fa fa-instagram fa-lg"></i> <i class="fa fa-twitter fa-lg"></i> <i
                                    class="fa fa-linkedin-square fa-lg"></i> <i class="fa fa-facebook"></i> </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <h5 class="heading">Services</h5>
                        <ul>
                            <li>IT Consulting</li>
                            <li>Development</li>
                            <li>Cloud</li>
                            <li>Support</li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <h5 class="heading">Industries</h5>
                        <ul class="card-text">
                            <li>Finance</li>
                            <li>Public Sector</li>
                            <li>Smart Office</li>
                            <li>Retail</li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <h5 class="heading">Company</h5>
                        <ul class="card-text">
                            <li>About Us</li>
                            <li>Blog</li>
                            <li>Contact</li>
                            <li>Join Us</li>
                        </ul>
                    </div>
                </div>
                <div class="divider mb-4"> </div>
                <div class="row" style="font-size:10px;">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="pull-left">
                            <p><i class="fa fa-copyright"></i> 2020 thezpdesign</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="pull-right mr-4 d-flex policy">
                            <div>Terms of Use</div>
                            <div>Privacy Policy</div>
                            <div>Cookie Policy</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer -->
    </div>
</body>

</html>
