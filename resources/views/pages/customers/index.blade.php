@extends('layouts.app')

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
                    <a href="#!" class="btn btn-sm custom-btn">Selengkapnya</a>
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
                        <a class="cta-btn align-middle text-decoration-none" href="#">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </section><!-- End Cta Section -->


    </div>
@endsection

@push('addon-script')
    <script>
        AOS.init();
    </script>
@endpush
