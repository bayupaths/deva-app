@extends('layouts.auth')

@section('content')
    <div class="page-auth" id="register">
        <div class="container col-md-5 container-register" data-aos="fade-up">
            {{-- <img src="{{ url('/assets/images/deva-logo.png') }}" alt="" height="40"
            class="d-inline-block align-text-top"> --}}
            {{-- <div class="col-md-6 text-center">
                    <img src="/assets/images/login-placeholder-new.jpg" alt="login-placeholder"
                        class="image-placeholder mb-4 mb-lg-none">
                </div> --}}
            <div class="row">
                <div class="text-center mt-2">
                    <div class="h4">Registrasi Konsumen</div>
                </div>
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="customer-name">Nama Lengkap</label>
                            <input id="customer-name" class="form-control @error('name') is-invalid @enderror"
                                type="text" name="name" placeholder="Masukan nama lengkap"
                                value="{{ old('name') }}" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="email-address">Alamat Email</label>
                            <input id="email-address" v-model="email" @change="changeForEmailAvailability()"
                                :class="{ 'is_invalid': this.email_unavailable }"
                                class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                placeholder="Masukan alamat email" value="{{ old('email') }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="phone-number">Nomor Telepon</label>
                            <input id="phone-number" class="form-control @error('phone_number') is-invalid @enderror"
                                type="text" name="phone_number" placeholder="Masukan nomor telepon"
                                value="{{ old('phone_number') }}" />
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input id="password" class="form-control @error('password') is-invalid @enderror"
                                type="password" name="password" placeholder="Masukan password"
                                value="{{ old('password') }}" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label" for="password-confirmation">Konformasi passowrd</label>
                            <input id="password-confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                name="password_confirmation" placeholder="Masukan konfirmasi password"
                                value="{{ old('password_confirmation') }}" />
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    Sudah memiliki akun? <a class="text-decoration-none" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        Vue.use(Toasted)

        var register = new Vue({
            el: '#register',
            mounted() {
                AOS.init();
            },
            methods: {
                changeForEmailAvailability: function() {
                    var self = this;
                    axios.get('{{ route('api-register-check') }}', {
                            params: {
                                email: self.email
                            }
                        })
                        .then(function(response) {
                            if (response.data == 'Available') {
                                self.$toasted.show(
                                    "Email anda tersedia! silahkan lanjutkan langkah selanjutnya", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                )
                                self.email_unavailable = false;
                            } else {
                                self.$toasted.error(
                                    "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                )
                                self.email_unavailable = true;
                            }
                            // handle success
                            console.log(response);
                        })
                }
            },
            data() {
                return {
                    email_unavailable: false
                }
            }
        });
    </script>
@endpush
