@extends('layouts.app')

@section('title')
    Deva Digital Print - Pusat Stempel Express
@endsection

@section('content')
    <div class="page-home">
        <section class="store-carousel">
            <div id="mainCarousel" class="carousel slide" data-aos="zoom-in">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" aria-current="true"
                        aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" class="active"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="{{ url('images/carousel.png') }}" class="d-block w-100" alt="Image Carousel">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="{{ url('images/carousel.png') }}" class="d-block w-100" alt="Image Carousel">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Berkualitas Tinggi, Cepat, dan Mudah! </h3>
                            <h5>Layanan Percetakan Digital Terbaik Kami</h6>
                                <p><a class="btn btn-lg btn-get-started" href="#">Mulai</a></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('images/carousel.png') }}" class="d-block w-100" alt="Image Carousel">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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

        <section class="services section-bg" id="serivices">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    Layanan Digital Printing
                </div>
                <div class="section-subtitle">
                    Inovasi Cetak Berkualitas untuk Setiap Kebutuhan,
                    Temukan Keunggulan Layanan dari Deva Digital Printing
                </div>
                <div class="row services-content row-cols-2 row-cols-md-5 g-3">
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-01.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-02.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-03.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-04.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-05.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-06.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-07.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-08.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-09.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="grid-item">
                            <img src="/images/service-10.png" alt="Image 1" class="image-fluid">
                            <div class="overlay"></div>
                            <div class="text-overlay">Text di bawah tengah</div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <a href="{{ route('product-page') }}" class="btn btn-sm custom-btn">Selengkapnya</a>
                </div>
            </div>
        </section>


        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">
                <div class="row">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3>Raih Kualitas Terbaik Bersama Deva Digital Print</h3>
                        <p>Cetak Berkualitas, Hemat Waktu. Pilih Solusi Percetakan Digital Terbaik!</p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle text-decoration-none" href="{{ route('login') }}">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </section><!-- End Cta Section -->


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
