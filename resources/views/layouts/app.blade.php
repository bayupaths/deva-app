<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('/assets/images/deva-logo.png') }}" type="image/png" />

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
            @include('includes.app.header')
        </header>

        {{-- Main --}}
        <main class="">
            @yield('content')
        </main>


        <!-- Footer -->
        <footer class="text-center text-lg-start text-white">
            @include('includes.app.footer')
        </footer>
        <!-- Footer -->

    </div>

    @stack('prepend-script')
    <script src="{{ url('vendor/aos/aos.js') }}"></script>
    @stack('addon-script')

</body>

</html>
