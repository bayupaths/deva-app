@extends('layouts.app')

@section('title')
    Deva Digital Print - Kontak Kami
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
                                <li class="breadcrumb-item active">Kontak </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-us" id="contact-us">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    Kontak Kami
                </div>
                <div class="section-subtitle">
                    Layanan pelanggan ramah dan responsif untuk setiap kebutuhan cetak Anda
                </div>
                <div class="row content contact-content">
                    <div class="col-lg-6  align-self-baseline" data-aos="fade-right" data-aos-delay="100">
                        <div class="info">
                            <div class="office-work">
                                <h4>Jam Kerja</h4>
                                <p>
                                    Senin - Sabtu, 09.00 - 17.00 WIB
                                </p>
                            </div>
                            <div class="address">
                                <h4>Alamat</h4>
                                <p>
                                    Dusun I, Susukan, Kec. Sumbang, Kabupaten Banyumas, Jawa Tengah 53183
                                </p>
                            </div>
                            <div class="phones">
                                <h4>Telepon</h4>
                                <p>082243378269</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pt-3 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                        <div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d588.2098501815989!2d109.2860552169827!3d-7.355191703808603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559476a92265f%3A0x2d682030c8a53f0e!2sDeva%20Stempel%20Express!5e0!3m2!1sid!2sid!4v1704752205539!5m2!1sid!2sid"
                                width="600" height="300" style="border:1px;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
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
