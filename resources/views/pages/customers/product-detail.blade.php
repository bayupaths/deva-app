@extends('layouts.app')

@section('title')
@endsection

@section('content')
    <div class="page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('product-page') }}">Produk</a>
                                </li>
                                <li class="breadcrumb-item active">Detail Produk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>


        <section class="product-gallery" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5 class="page-title">Detail Produk</h5>
                    </div>
                </div>
                <div class="row show-product-detail">
                    <div class="col-lg-6 col-md-6 product-image mr-4" data-aos="zoom-in">
                        <div class="row">
                            <transition name="slide-fade" mode="out-in">
                                <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                    alt="Detail Product">
                            </transition>
                        </div>
                        <div class="row">
                            <div class="col mt-2" v-for="(photo, index) in photos" :key="photo.id" data-aos="zoom-in"
                                data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="">
                                </a>
                            </div>

                            <nav class="mt-2" data-aos="fade-up">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-description" type="button" role="tab"
                                        aria-controls="nav-description" aria-selected="true">Deskripsi</button>
                                    <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-review" type="button" role="tab"
                                        aria-controls="nav-review" aria-selected="false">Review</button>
                                </div>
                            </nav>
                            <div class="tab-content mt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                    aria-labelledby="nav-description-tab">{{ $product->description }}</div>
                                <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                                    ...</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 product-detail" data-aos="fade-up">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <h5 class="product-category">Kategori : {{ $product->productCategory->name }}</h5>
                        <h5 class="product-price">Harga : <span>RP. {{ number_format($product->price) }}</span></h5>
                        <form action="{{ route('purchase.order') }}" method="GET">
                            @csrf
                            <div class="product-specification">
                                <h5>Spesifikasi Produk</h5>
                                @foreach ($product->productSpecification->groupBy('spec_type') as $specType => $specifications)
                                    <label for="{{ $specType }}">{{ $specType }}:</label>
                                    <select class="form-select" name="{{ $specType }}" id="{{ $specType }}">
                                        <option>Pilih {{ $specType }}</option>
                                        @foreach ($specifications as $specification)
                                            <option value="{{ $specification->spec_id }}">{{ $specification->spec_value }}
                                                ({{ $specification->unit }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                @endforeach
                            </div>
                            <div class="action">
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-md btn-order">Login Untuk Buat Pesanan</a>
                                @endguest
                                @auth
                                    <button class="btn btn-md btn-order" type="submit">Buat Pesanan</button>
                                @endauth
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row show-related-product mt-4">
                    <div class="col-12" data-aos="fade-up">
                        <h5 class="page-title">Produk Lainnya</h5>
                    </div>
                    <div class="col-10 product-content">
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            @php
                                $incrementProduct = 0;
                            @endphp
                            @foreach ($relatedProducts as $related)
                                <div class="col">
                                    <div class="card product-card" data-aos="fade-up"
                                        data-aos-delay="{{ $incrementProduct += 100 }}">
                                        <a href="{{ route('productDetail', $related->slug) }}"
                                            class="text-decoration-none">
                                            <div class="products-thumbnail">
                                                @if ($related->productGallery()->exists())
                                                    <div class="products-image"
                                                        style="background-image: url('{{ Storage::url($related->productGallery->first()->file_path) }}')">
                                                    </div>
                                                @else
                                                    <div class="products-image"
                                                        style="background-image: url('{{ url('/images/no-image.png') }}')">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <h5 class="product-title">{{ $related->name }}</h5>
                                                <p class="product-price">Rp. {{ number_format($related->price) }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="{{ url('/vendor/vue/vue.js') }}"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 1,
                photos: [
                    @foreach ($product->productGallery as $gallery)
                        {
                            id: {{ $gallery->galery_id }},
                            url: "{{ Storage::url($gallery->file_path) }}",
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                }
            }
        });
    </script>
@endpush
