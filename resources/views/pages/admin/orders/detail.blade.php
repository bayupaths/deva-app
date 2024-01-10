@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar Pemesanan</h1>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-7 col-xxl-9 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-1">Order ID: {{ $order->order->order_code }}</h4>
                                <div class="d-flex align-items-center">
                                    <small>Tanggal Order:
                                        {{ Carbon\Carbon::parse($order->order->order_date)->format('d F Y, H:i') ?? '' }}</small>

                                    @if ($order->payment)
                                        @php
                                            $colorPayment = \App\Providers\OrderHelperProvider::getPaymentStatusColor($order->payment->payment_status);
                                        @endphp
                                        <span
                                            class="badge {{ $colorPayment }} ms-2">{{ $order->payment->payement_status }}</span>
                                    @else
                                        <span class="badge bg-secondary ms-2">Unpaid</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <a href="#!" class="btn btn-primary">Invoice</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
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
                                                <a href="{{ route('product.show', $order->product->slug) }}">
                                                    <img src="{{ Storage::url($order->product->productGallery->first()->file_path ?? '') }}"
                                                        alt="{{ $order->product->productGallery->first()->file_name }}"
                                                        class="img-thumbnail mx-auto d-block rounded-3" width="100px">
                                                </a>
                                                <div class="ms-3">
                                                    <h5 class="mb-0">
                                                        <a href="{{ route('product.show', $order->product->slug) }}"
                                                            class="text-inherit">{{ $order->product->name }}</a>
                                                    </h5>
                                                    <small>Kategori : {{ $order->product->productCategory->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp. {{ number_format($order->product_price) }}</td>
                                        <td>{{ $order->product_quantity }}</td>
                                        <td>Rp. {{ number_format($order->subtotal) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-1">Detail Order</h4>
                                <div class="d-flex align-items-center">
                                    <small>Status Order : </small>
                                    @php
                                        $colorStatus = \App\Providers\OrderHelperProvider::getOrderStatusColor($order->order->order_status);
                                    @endphp
                                    <span class="badge {{ $colorStatus }} ms-2">{{ $order->order->order_status }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex align-items-center">
                                <label class="form-label me-4 mb-0">Status</label>
                                <select class="form-select" aria-label="Default select example" id="orders-status">
                                    <option value="UNPAID">Unpaid</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="SHIPPING">Shipping</option>
                                    <option value="SUCCESS">Success</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Produk: {{ $order->product->name }}</h5>
                        <p class="card-text">
                            <strong>Spesifikasi Produk:</strong><br>
                            @forelse ($order->productSpecification()->get() as $item)
                                - {{ $item->spec_type }} : {{ $item->spec_value }} <br>
                            @empty
                                - (kosong)
                            @endforelse
                        </p>
                        <p class="card-text">
                            <strong>Detail Order:</strong><br>
                            - Jumlah: 500 pcs<br>
                            - Total Harga: $250.00<br>
                            - Tanggal Pemesanan: 27 Desember 2023<br>
                        </p>
                        <p class="card-text">
                            <strong>Catatan Pembeli:</strong><br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et massa eget justo luctus
                            elementum.
                        </p>
                        <p class="card-text">
                            <strong>Status Order:</strong> <span class="badge bg-success">Diproses</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xxl-3 col-12">
                <div class="card mb-4 mt-4 mt-lg-0">
                    <div class="card-header">
                        <h4 class="mb-0">Order Summary</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead class="table-light">
                                <tr>

                                    <th scope="col">Descriptions</th>
                                    <th scope="col">Amounts</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>Sub Total :</td>
                                    <td>$340.00</td>

                                </tr>
                                <tr>

                                    <td>Discount (DIS15%) : </td>
                                    <td>-$51.00</td>

                                </tr>
                                <tr>

                                    <td>Shipping Charge :</td>
                                    <td>$15.00</td>

                                </tr>
                                <tr>

                                    <td>Tax Vat 19% (included) :</td>
                                    <td>$64.00</td>

                                </tr>
                                <tr>

                                    <td>Total Amount</td>
                                    <td>$368.00</td>

                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Payment Details</h4>
                    </div>
                    <div class="card-body">

                        <div>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between mb-2"><span>Transactions:
                                    </span> <span class="text-dark">#DU444TO10000</span></li>
                                <li class="d-flex justify-content-between mb-2"><span>Payment Method:
                                    </span> <span class="text-dark">Credit Card</span></li>
                                <li class="d-flex justify-content-between mb-2"><span>Card Holder Name:
                                    </span> <span class="text-dark">Harold Gonzalez</span></li>
                                <li class="d-flex justify-content-between mb-2"><span>Card Number:
                                    </span> <span class="text-dark">xxxx xxxx xxxx 6779</span></li>
                                <li class="d-flex justify-content-between"><span>Total Amount: </span>
                                    <span class="text-dark ">$368.00</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @elseif (session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('errors') }}',
            });
        @endif
    </script>
@endpush
