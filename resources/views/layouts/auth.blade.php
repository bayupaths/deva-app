<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    @stack('addon-style')
</head>

<body id="page-auth">
    <div id="app">
        <main class="w-100">
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="pt-4 pb-2">
                            {{ date('Y') }} Copyright <a class="text-decoration-none" href="http://github.com/bayupaths">Bayu Purnomo</a>. All rights
                            reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('prepend-script')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @stack('addon-script')
</body>

</html>
