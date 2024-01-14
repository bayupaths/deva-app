@extends('layouts.app')

@section('title')
    Deva Digital Print - Tentang Kami
@endsection

@section('content')
    <div class="page-home">

        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Tentang </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="about-us">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    Tentang Kami
                </div>
                <div class="row content about-content">
                    <div class="col-lg-6  align-self-baseline" data-aos="fade-right" data-aos-delay="100">
                        <img src="/images/about-image.png" class="img-fluid" alt />
                    </div>
                    <div class="col-lg-6 pt-3 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                        <p>
                            Deva Digital Print: Inovasi Percetakan Digital Terkemuka. Menghadirkan Solusi Cetak Berkualitas
                            Tinggi dengan Kecepatan dan Kemudahan sebagai Prioritas Utama. Percayakan Kreativitas Anda pada
                            Layanan Kami yang Profesional dan Handal. Kami berkomitmen untuk memenuhi kebutuhan cetak Anda
                            dengan layanan terbaik, teknologi canggih, dan hasil yang memukau.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script>
        AOS.init();
    </script>
@endpush
