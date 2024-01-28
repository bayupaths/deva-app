@extends('layouts.app')

@section('title')
    Deva Digital Print
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
                    <!-- Konten Produk -->
                    <div class="col-md-9 product-content">
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            @php
                                $incrementProduct = 0;
                            @endphp
                            @forelse ($products as $product)
                                <div class="col">
                                    <div class="card product-card" data-aos="fade-up"
                                        data-aos-delay="{{ $incrementProduct += 100 }}">
                                        <a href="{{ route('productDetail', $product->slug) }}" class="text-decoration-none">
                                            <div class="products-thumbnail">
                                                @if ($product->galleries()->exists())
                                                    <div class="products-image"
                                                        style="background-image: url('{{ Storage::url($product->galleries->first()->file_path) }}')">
                                                    </div>
                                                @else
                                                    <div class="products-image"
                                                        style="background-image: url('{{ url('/images/no-image.png') }}')">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <h5 class="product-title">{{ $product->name }}</h5>
                                                <p class="product-price">Rp. {{ number_format($product->price) }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5" data-aos="fade-up" data-aos-delay="100">
                                    Produk Tidak Tersedia
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col category-sidebar" data-aos="fade-up" data-aos-delay="200">
                            <div class="label">
                                <h5 class="text-wrapper">Kategori Produk</h5>
                            </div>
                            <form action="{{ route('product-page') }}" class="d-flex" method="GET">
                                <input class="form-control" type="search" name="search" placeholder="Cari Kategori"
                                    aria-label="Search">
                            </form>
                            <ul class="list-group-categories">
                                <li class="list-item">
                                    <a href="{{ route('product-page') }}"
                                        class="item-link {{ request()->routeIs('product-page') ? 'active' : '' }}">Semua
                                        Kategori</a>
                                </li>
                                @forelse ($categories as $category)
                                    <li class="list-item">
                                        <a href="{{ route('productsByCategory', $category->slug) }}"
                                            class="item-link {{ request()->route('slug') == $category->slug ? 'active' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
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
