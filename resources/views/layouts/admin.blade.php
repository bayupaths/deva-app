<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    {{-- Font --}}
    @stack('prepend-style')
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Poppins:ital,wght@0,300;0,400;0,600;1,300&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    @vite(['resources/sass/admin/main.scss', 'resources/js/admin/main.js'])
    @stack('addon-style')
</head>

<body>

    <div id="app" class="wrapper page-dashboard">
        @include('includes.admin.sidebar')

        <div class="main">
            @include('includes.admin.navbar')

            <main class="content">
                @yield('content')
            </main>

            @include('includes.admin.footer')
        </div>
    </div>

    @stack('prepend-script')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @stack('addon-script')

</body>

</html>
