@extends('layouts.app')

@section('title')
    Deva Digital Print
@endsection

@section('content')
    <div class="page-order">
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
                                <li class="breadcrumb-item active">Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="order-detail" id="order-detail">
            <div class="container">
                <div class="row">
                    <div class="col-10" data-aos="fade-up">
                        <h5 class="page-title">Order</h5>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-dela="100">
                    <div class="col-10 table-responsive">
                        <table class="table table-borderless table-order">
                            <thead>
                                <tr>
                                    <td>Gambar</td>
                                    <td>Produk</td>
                                    <td>Harga</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{-- @if ($product->productGallery()->exists())
                                            <img src="{{ Storage::url($product->productGallery->first()->file_path) }}"
                                                alt="..." class="order-image">
                                        @endif --}}
                                    </td>
                                    <td>
                                        {{-- <div class="product-title">{{ $product->name }}</div>
                                        <div class="product-subtitle">by {{ $product->productCategory->name }}</div> --}}
                                    </td>
                                    <td>
                                        {{-- <div class="product-title">${{ number_format($product->price) }}</div>
                                        <div class="product-subtitle">USD</div> --}}
                                    </td>
                                    <td>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control w-100" name="quantity" min="0"
                                                max="500">
                                            <label for="quantity">Pcs</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-10">
                            <hr>
                        </div>
                        <div class="col-12">
                            <h5 class="mb-4">Order Details</h5>
                        </div>
                        {{-- <input type="hidden" name="total_price" value="{{ $totalPrice }}"> --}}
                        <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                            <h6 class="mb-2">Spesifikasi Produk</h6>
                            <div class="col-md-5 mb-2">
                                <div class="form-group">
                                    <label for="address_one">Address 1</label>
                                    <input type="text" class="form-control" id="address_one" aria-describedby="emailHelp"
                                        name="address_one" value="Setra Duta Cemara" />
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="form-group">
                                    <label for="address_two">Address 2</label>
                                    <input type="text" class="form-control" id="address_two" aria-describedby="emailHelp"
                                        name="address_two" value="Blok B2 No. 34" />
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="form-group">
                                    <label for="address_two">Address 2</label>
                                    <input type="text" class="form-control" id="address_two" aria-describedby="emailHelp"
                                        name="address_two" value="Blok B2 No. 34" />
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="form-group">
                                    <label for="address_two">Address 2</label>
                                    <input type="text" class="form-control" id="address_two" aria-describedby="emailHelp"
                                        name="address_two" value="Blok B2 No. 34" />
                                </div>
                            </div>
                            <div class="col-md-10 mb-2">
                                <div class="form-group">
                                    <label for="orderDescriptions">Catatan Pesanan</label>
                                    <textarea class="form-control" name="description" id="orderDescriptions" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Upload Gambar Desain</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-10">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h5 class="mb-2">Informasi Pembayaran</h5>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-3">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Harga Produk</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Jumlah</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                                Order
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </div>

    {{-- @foreach ($product->productSpecification->groupBy('spec_type') as $specType => $specifications)
    <label for="{{ $specType }}">{{ $specType }}:</label>
    <select name="{{ $specType }}" id="{{ $specType }}">
        @foreach ($specifications as $specification)
            <option value="{{ $specification->id }}">{{ $specification->spec_value }} ({{ $specification->unit }})
            </option>
        @endforeach
    </select>
    <br>
@endforeach --}}
@endsection
