<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @stack('prepend-style')
    <link rel="stylesheet" href="{{ url('vendor/aos/aos.css') }}">
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
                            <span class="navbar-toggler-icon">
                                <i data-feather="menu"></i>
                            </span>
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
                                    <a class="nav-link" href="#">Tentang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Kontak</a>
                                </li>

                            </ul>
                            <form class="d-flex navbar-form">
                                <input class="form-control me-2" type="search" placeholder="Search"
                                    aria-label="Search">
                            </form>
                            @guest
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="btn register-btn nav-link">Daftar</a>
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

        {{-- Main --}}
        <main class="">
            @yield('content')
        </main>


        <!-- Footer -->
        <footer class="text-center text-lg-start text-white">
            <!-- Section: Links  -->
            <section class="footer-nav">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-5 col-lg-4 col-xl-4 mx-auto mb-4">
                            <!-- Content -->
                            <img src="{{ url('/assets/images/deva-logo.png') }}" alt="" height="40"
                                class="mb-4 mt-0 d-inline-block mx-auto">
                            <p>
                                Deva Digital Print: Inovasi Percetakan Digital Terkemuka. Menghadirkan Solusi Cetak
                                Berkualitas Tinggi dengan Kecepatan dan Kemudahan sebagai Prioritas Utama. Percayakan
                                Kreativitas Anda pada Layanan Kami yang Profesional dan Handal
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold">Kategori</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                <a href="#!" class="text-white">Digital Printing</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Print Media</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Merchendes</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Layanan Desain</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md- col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold">Useful links</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                <a href="#!" class="text-white">Your Account</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Become an Affiliate</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Shipping Rates</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Help</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold">Contact</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                            <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="copyright text-center p-3">
                © {{ date('Y') }} Copyright: Deva Digital Print
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->

    </div>

    @stack('prepend-script')
    <script src="{{ url('vendor/aos/aos.js') }}"></script>
    @stack('addon-script')

</body>

</html>
