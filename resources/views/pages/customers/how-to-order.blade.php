@extends('layouts.app')

@section('title')
    Deva Digital Print - Cara Melakukan Pemesanan Produk
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
                                <li class="breadcrumb-item active">Cara Order </li>
                            </ol>
                        </nav>
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
