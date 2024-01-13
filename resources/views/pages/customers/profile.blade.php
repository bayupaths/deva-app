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
                                <li class="breadcrumb-item active">Profile</li>
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
                        <div class="card mb-3 card-profile">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Profile</h5>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ $customer->photos ? Storage::url($customer->photos) : url('/assets/images/profile/default-user-icon.png') }}"
                                    alt="{{ $customer->name }}" class="img-fluid rounded-circle mb-2" width="128"
                                    height="128" />
                                <h5 class="card-title mb-0">{{ $customer->name }}</h5>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <h5 class="h6 card-title">Menu</h5>
                                <ul class="list-unstyled list-menu mb-0">
                                    <li class="menu-item mb-1">
                                        <a class="menu-link" href="#">
                                           Riwayat Order
                                           <span class="badge bg-success">3</span>
                                        </a>
                                    </li>
                                    <li class="menu-item mb-1">
                                        <a class="menu-link" href="#">
                                           Invoice
                                           <span class="badge bg-success">3</span>
                                        </a>
                                    </li>
                                    <li class="menu-item mb-1">
                                        <a class="menu-link" href="#">
                                            Pengaturan Profile
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <h5 class="h6 card-title">Informasi Konsumen</h5>
                                <ul class="list-unstyled list-menu  mb-0">
                                    <li class="mb-1 menu-item">
                                        <span data-feather="mail" class="feather-sm me-1"></span> Email
                                        <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
                                    </li>
                                    <li class="mb-1 menu-item">
                                        <span data-feather="phone" class="feather-sm me-1"></span> Telepon
                                        {{ $customer->phone_number }}
                                    </li>
                                    <li class="mb-1 menu-item">
                                        <span data-feather="home" class="feather-sm me-1"></span> Alamat
                                        {{ $customer->address ?? '-' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Riwayat Pemesanan</h5>
                            </div>
                            <div class="card-body h-100">
                                <div class="table-responsive">
                                    <table id="history-order-table" class="table table-hover my-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Tanggal</th>
                                                <th>Produk</th>
                                                <th>Status Bayar</th>
                                                <th>Total</th>
                                                <th>Status Order</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $item)
                                                <tr>
                                                    <td>{{ $item->order->order_code }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->order->order_date)->format('d F Y, H:i') ?? '' }}
                                                    </td>
                                                    <td>{{ $item->product->name }}</td>

                                                    @if ($item->order->payment)
                                                        @php
                                                            $statusColor = \App\Providers\OrderHelperProvider::getPaymentStatusColor($item->order->payment->payment_status);
                                                        @endphp
                                                        <td> <a href="#">
                                                                <span
                                                                    class="badge {{ $statusColor }}">{{ $item->order->payment->payment_status }}</span>
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge bg-secondary">Unpaid</span>
                                                        </td>
                                                    @endif
                                                    <td>Rp. {{ number_format($item->order->total_price) }}</td>
                                                    @php
                                                        $statusColor = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->order->order_status);
                                                    @endphp
                                                    <td>
                                                        <a href="#"><span
                                                                class="badge {{ $statusColor }}">{{ $item->order->order_status }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.order.details', $item->order->order_code) }}"
                                                            class="btn btn-primary">
                                                            <i data-feather="chevron-right" class="feather-14"></i>
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
