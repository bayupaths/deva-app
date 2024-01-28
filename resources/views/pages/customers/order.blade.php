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
                                        @if ($product->galleries()->exists())
                                            <img src="{{ Storage::url($product->galleries->first()->file_path) }}"
                                                alt="..." class="order-image" width="100px">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="product-title">{{ $product->name }}</div>
                                        <div class="product-subtitle">kategori : {{ $product->categories->name }}</div>
                                    </td>
                                    <td>
                                        <div class="product-title">Rp. {{ number_format($product->price) }}</div>
                                    </td>
                                    <td>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control w-100" name="quantity" min="0"
                                                max="500" id="quantityProduct">
                                            <label for="quantity">Pcs</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="productID" value="{{ $product->id }}">
                    <input type="hidden" name="product_price" id="productPrice" value="{{ $product->price }}">
                    <input type="hidden" name="total_price" id="finalTotalPrice" value="0">
                    <input type="hidden" name="product_quantity" id="finalProductQty" value="0">
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
                            @forelse ($product->specifications->groupBy('spec_type') as $specType => $specs)
                                <div class="col-md-5 mb-2">
                                    <div class="form-group">
                                        <label for="{{ $specType }}">{{ $specs->first()->name }}</label>
                                        <select class="form-select form-control" name="specs[]" id="{{ $specType }}">
                                            <option value="" disabled>Pilih {{ $specs->first()->name }}</option>
                                            @foreach ($specs as $spec)
                                                <option value="{{ $spec->id }}"
                                                    {{ $request->input($specType) == $spec->id ? 'selected' : '' }}>
                                                    {{ $spec->spec_value }}
                                                    {{ $spec->unit != null ? "($spec->unit)" : "" }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                            <h6 class="mb-2 mt-4">Detail Pemesanan Produk</h6>
                            <div class="col-md-10 mb-2">
                                <div class="form-group">
                                    <label for="orderDescriptions">Catatan Pesanan</label>
                                    <textarea class="form-control @error('order_note') is-invalid @enderror" name="order_note" id="orderDescriptions"
                                        rows="5"></textarea>
                                    @error('order_note')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Upload Gambar Desain</label>
                                    <input class="form-control @error('images') is-invalid @enderror" type="file"
                                        id="formFile" name="images">
                                    @error('images')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
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
                            <div class="product-title">Rp. {{ number_format($product->price) }}</div>
                            <div class="product-subtitle">Harga Produk</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title" id="finalQuantityProduct">0</div>
                            <div class="product-subtitle">Jumlah Produk</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title" id="totalPrice">Rp. 0</div>
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
@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen-elemen HTML yang diperlukan
            var quantityProduct = document.getElementById('quantityProduct');
            var productPrice = document.getElementById('productPrice');
            var total = document.getElementById('totalPrice');
            var finalQuantityProduct = document.getElementById('finalQuantityProduct');
            var totalInput = document.getElementById('finalTotalPrice');
            var finalProductQty = document.getElementById('finalProductQty');

            quantityProduct.addEventListener('change', updateTotalHarga);

            function updateTotalHarga() {
                var jumlahProduk = parseInt(quantityProduct.value) || 0;
                var hargaPerProduk = parseFloat(productPrice.value) || 0;

                // Menghitung total harga
                var totalPrice = jumlahProduk * hargaPerProduk;

                var formattedTotalPrice = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(totalPrice);

                // Memperbarui tampilan total harga
                total.textContent = formattedTotalPrice;
                finalQuantityProduct.textContent = jumlahProduk;
                totalInput.value = totalPrice.toFixed(2);
                finalProductQty.value = jumlahProduk;
            }
        });
    </script>
@endpush
