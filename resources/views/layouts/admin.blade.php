<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Poppins:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    @vite(['resources/sass/admin/main.scss', 'resources/js/admin/main.js'])
</head>

<body>

    <div id="app" class="wrapper">
        @include('includes.admin.sidebar')

        <div class="main">
            @include('includes.admin.navbar')

            <main class="content">
                @yield('content')
            </main>

            @include('includes.admin.footer')
        </div>
    </div>


</body>

</html>
