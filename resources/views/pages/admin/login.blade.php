<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administrator Login</title>

    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    @stack('addon-style')
</head>

<body id="page-auth">
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="text-center mt-4">
                                <div class="h4">Login Administator</div>
                            </div>
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form action="{{ route('admin-login-process') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="emailAdmin">Email</label>
                                            <input id="emailAdmin"
                                                class="form-control @error('email') is-invalid @enderror" type="email"
                                                name="email" placeholder="Masukan email"
                                                value="{{ old('email') }}" />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="passwordAdmin">Password</label>
                                            <input id="passwordAdmin"
                                                class="form-control @error('password') is-invalid @enderror"
                                                type="password" name="password" placeholder="Masukan password"
                                                value="{{ old('password') }}" />
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="d-grid gap-2 mt-4">
                                            <button type="submit" class="btn btn-md btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="pt-4 pb-2">
                        {{ date('Y') }} Copyright <a class="text-decoration-none"
                            href="http://github.com/bayupaths">Bayu Purnomo</a>. All rights
                        reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @stack('prepend-script')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @stack('addon-script')
</body>

</html>
