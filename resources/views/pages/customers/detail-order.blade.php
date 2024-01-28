@extends('layouts.app')

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
                    <div class="col-lg-6 col-xxl-8 col-12 m-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-1">Order ID: {{ $item->orders->order_code }}</h5>
                                <div class="d-flex align-items-center mb-2">
                                    <small>Tanggal Order:
                                        {{ Carbon\Carbon::parse($item->orders->order_date)->format('d F Y, H:i') ?? '' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 table-centered">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Items</th>
                                        <th scope="col">Amounts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#">
                                                    <img src="{{ Storage::url($item->products->galleries->first()->file_path ?? '') }}"
                                                        alt="{{ $item->products->galleries->first()->file_name }}"
                                                        class="img-thumbnail mx-auto d-block rounded-3" width="100px">
                                                </a>
                                                <div class="ms-3">
                                                    <h5 class="mb-0">
                                                        <a class="text-decoration-none" href="#"
                                                            class="text-inherit">{{ $item->products->name }}</a>
                                                    </h5>
                                                    <small>Kategori : {{ $item->products->categories->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp. {{ number_format($item->product_price) }}</td>
                                        <td>{{ $item->product_quantity }}</td>
                                        <td>Rp. {{ number_format($item->subtotal) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h5 class="mb-1">Detail Order</h5>
                                <div class="d-flex align-items-center">
                                    <small>Status Order : </small>
                                    @php
                                        $colorStatus = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->orders->order_status);
                                    @endphp
                                    <span class="badge {{ $colorStatus }} ms-2">{{ $item->orders->order_status }}</span>
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="detail-order mt-1 mb-2">
                            <strong>Produk: {{ $item->products->name }}</strong>
                            <p class="card-text">
                                <strong>Spesifikasi Produk:</strong><br>
                                @forelse ($item->specifications()->get() as $spec)
                                    - {{ $spec->name }} : {{ $spec->spec_value . " ($spec->unit)" }} <br>
                                @empty
                                    - (kosong)
                                @endforelse
                            </p>
                            <p class="card-text">
                                <strong>Keterangan</strong><br>
                                - Jumlah: {{ $item->product_quantity }} pcs<br>
                                - Total Harga: Rp. {{ number_format($item->subtotal) }}<br>
                                - Tanggal Pemesanan:
                                {{ Carbon\Carbon::parse($item->orders->order_date)->format('d F Y') ?? '' }}<br>
                            </p>
                            <p class="card-text">
                                <strong>Catatan Pembeli:</strong><br>
                                {!! $item->order_note ?? '-' !!}
                            </p>
                            <p class="card-text">
                                <strong>Gambar Desain:</strong><br>

                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xxl-3 col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-1">Detail Pembayaran</h5>
                                <div class="d-flex align-items-center">
                                    <small>Status Pembayaran : </small>
                                    @if ($item->invoices)
                                        @php
                                            $colorPayment = \App\Providers\OrderHelperProvider::getPaymentStatusColor($item->invoices->status);
                                        @endphp
                                        <span class="badge {{ $colorPayment }} ms-2">{{ $item->invoices->status }}</span>
                                    @else
                                        <span class="badge bg-secondary ms-2">Unpaid</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex flex-column">
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Sub Total</span>
                                    <span class="text-dark">Rp. {{ number_format($item->subtotal) }}</span>
                                </li>
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Total Bayar</span>
                                    <span class="text-dark">Rp. {{ number_format($item->orders->total_price) }}</span>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('invoice.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $item->orders->id }}">
                            <input type="hidden" name="total_amount" value="{{ $item->orders->total_price }}">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="paymentMethod">Metode Bayar</label>
                                <select class="form-select @error('payment_method') is-invalid  @enderror"
                                    id="paymentMethod" name="payment_method">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                                @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-md btn-primary" type="submit">Bayar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
