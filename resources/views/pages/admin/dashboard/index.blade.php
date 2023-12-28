@extends('layouts.admin')

@section('title')
    Deva Digital Print
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Dashboard Admin</h1>
        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Penjualan</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">Rp. {{ number_format($totalSales) }}</h1>
                                    {{-- <div class="mb-0">
                                        <span class=""> <i class="mdi mdi-arrow-bottom-right"></i>  {{ $precentageSales }}% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Konsumen</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalCustomer }}</h1>
                                    {{-- <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 0% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Pendapatan</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">Rp. {{ number_format($totalRevenue) }}</h1>
                                    {{-- <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  {{ $precentageRevenue }}% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Pesanan</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalOrder }}</h1>
                                    {{-- <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Transaksi Terkini</h5>
                    </div>
                    <div class="card-body py-3">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Kode Invoice</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentPayments as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_code }}</td>
                                        <td>{{ Carbon\Carbon::parse($payment->payment_date)->format('d F Y H:i') ?? '' }}
                                        </td>
                                        <td>{{ $payment->order->user->name }}</td>
                                        <td>Rp. {{ number_format($payment->payment_amount) }}</td>
                                        @php
                                            $statusColor = \App\Providers\OrderHelperProvider::getPaymentStatusColor($payment->payment_status);
                                        @endphp
                                        <td> <a href="#">
                                                <span
                                                    class="badge {{ $statusColor }}">{{ $payment->payment_status }}</span>
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

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Daftar Pesanan</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Kode Order</th>
                                    <th>Tanggal Order</th>
                                    <th>Produk</th>
                                    <th>Konsumen</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentOrders as $item)
                                    <tr>
                                        <td>{{ $item->order->order_code }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->order->order_date)->format('d F Y') ?? '' }}
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->order->user->name }}</td>
                                        @php
                                            $statusColor = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->order->order_status);
                                        @endphp
                                        <td>
                                            <a href="#"><span
                                                    class="badge {{ $statusColor }}">{{ $item->order->order_status }}</span></a>
                                        </td>

                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Konsumen</h5>
                        </div>
                        <div class="card-body d-flex w-100">
                            {{-- <div class="align-self-center chart chart-lg">
                                <canvas id="chartjs-dashboard-bar"></canvas>
                            </div> --}}
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
                title: 'Login Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
@endpush
