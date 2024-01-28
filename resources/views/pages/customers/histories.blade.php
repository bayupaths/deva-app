@extends('layouts.app')

@section('content')
    <div class="page-profile">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">History</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="profile-customer" data-aos="fade-down" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <ul class="list-group">
                            <a href="">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Riwayat Order
                                    <span class="badge bg-primary rounded-pill">{{ $countOrders }}</span>
                                </li>
                            </a>
                            <a href="">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Invoice
                                    <span class="badge bg-primary rounded-pill">{{ $countInvoice }}</span>
                                </li>
                            </a>
                        </ul>
                    </div>

                    <div class="col-md-8 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Riwayat Pemesanan</h5>
                            </div>
                            <div class="card-body h-100">
                                <div class="table-responsive">
                                    <table id="history-order-table" class="table table-sm table-hover my-0"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Tanggal</th>
                                                <th>Produk</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $item)
                                                <tr>
                                                    <td>{{ $item->orders->order_code }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->orders->order_date)->format('d F Y') ?? '' }}
                                                    </td>
                                                    <td>{{ $item->products->name }}</td>
                                                    <td>Rp. {{ number_format($item->orders->total_price) }}</td>
                                                    @php
                                                        $statusColor = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->orders->order_status);
                                                    @endphp
                                                    <td>
                                                        <a href="#">
                                                            <span
                                                                class="badge {{ $statusColor }}">{{ $item->orders->order_status }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
