@extends('layouts.app')

@section('title')
@endsection

@section('content')
    <div class="page-product">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Produk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>


        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5 class="page-title">Produk</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 category-sidebar">

                    </div>
                    <!-- Konten Produk -->
                    <div class="col-md-9 product-content">

                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <!-- Produk 1 -->
                            <div class="col">
                                <div class="card product-card">
                                    <a href="#" target="_blank" class="text-decoration-none">
                                        <img src="{{ url('/images/service-01.png') }}" class="card-img-top product-image"
                                            alt="Produk 1">
                                        <div class="card-body">
                                            <h5 class="product-title">Produk 1</h5>
                                            <p class="product-price">Rp. 50.000</p>
                                        </div>
                                        <div class="overlay">
                                            <div class="text-overlay">
                                                <h5 class="card-title">Nama Produk 2</h5>
                                                <p class="card-text">Deskripsi singkat produk.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
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
