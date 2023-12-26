@extends('layouts.auth')

@section('content')
    <div class="page-auth">
        <div class="container container-auth" data-aos="fade-up">
            <img src="{{ url('/assets/images/deva-logo.png') }}" alt="" height="40"
            class="d-inline-block align-text-top">
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <img src="/assets/images/login-placeholder-new.jpg" alt="login-placeholder"
                        class="image-placeholder mb-4 mb-lg-none w-500">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="text-center mt-2">
                            <div class="h4">Selamat Datang</div>
                            <p class="">
                                Silahkan login untuk melanjutkan
                            </p>
                        </div>
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        name="email" placeholder="Masukan alamat email"
                                        value="{{ old('email') ? old('email') : '' }}" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" placeholder="Enter your password"
                                        value="{{ old('password') ? old('password') : '' }}" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-check align-items-center">
                                    <input id="customControlInline" type="checkbox" class="form-check-input"
                                        value="remember-me" name="remember-me" checked>
                                    <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            Belum memiliki akun? <a href="{{ route('register') }}">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
