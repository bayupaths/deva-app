@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar Pemesanan</h1>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}"
                        class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 d-flex align-items-center mt-3 mt-md-0">
                                <label class="form-label me-4 mb-0">Status</label>
                                <select class="form-select" aria-label="Default select example" id="orders-status">
                                    <option selected value="all">All</option>
                                    <option value="PENDING"
                                        {{ request()->route('status') === 'PENDING' ? 'selected' : '' }}>Pending</option>
                                    <option value="PROCESSED"
                                        {{ request()->route('status') === 'PROCESSED' ? 'selected' : '' }}>Processed
                                    </option>
                                    <option value="FINISHED"
                                        {{ request()->route('status') === 'FINISHED' ? 'selected' : '' }}>Finished</option>
                                    <option value="CANCELED"
                                        {{ request()->route('status') === 'CANCELED' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>

                            <div class="col-lg-8 text-lg-end mt-3 mt-lg-0">

                                <a href="#!" class="btn btn-primary me-2">+ Add New Order</a>
                                <a href="#!" class="btn btn-light ">Export</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="orders-table" class="table table-hover my-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Nama</th>
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
                                            <td>{{ $item->orders->order_code }}</td>
                                            <td>{{ $item->orders->users->name }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->orders->order_date)->format('d F Y, H:i') ?? '' }}
                                            </td>
                                            <td>{{ $item->products->name }}</td>

                                            @if ($item->orders->invoices)
                                                @php
                                                    $statusColor = \App\Providers\OrderHelperProvider::getPaymentStatusColor($item->orders->invoices->status);
                                                @endphp
                                                <td> <a href="#">
                                                        <span
                                                            class="badge {{ $statusColor }}">{{ $item->orders->invoices->status }}</span>
                                                    </a>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge bg-secondary">Unpaid</span>
                                                </td>
                                            @endif
                                            <td>Rp. {{ number_format($item->orders->total_price) }}</td>
                                            @php
                                                $statusColor = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->orders->order_status);
                                            @endphp
                                            <td>
                                                <a href="#"><span
                                                        class="badge {{ $statusColor }}">{{ $item->orders->order_status }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.order.details', $item->orders->order_code ) }}" class="btn btn-primary">
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
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>

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

        document.addEventListener('DOMContentLoaded', function() {
            var ordersTable = document.querySelector('#orders-table');
            let dataTables = new DataTable(ordersTable, {
                responsive: true
            });

            document.getElementById('orders-status').addEventListener('change', function() {
                var status = this.value;
                var routeUrl;
                if (status == 'all') {
                    routeUrl = "{{ route('admin.orders') }}";
                } else {
                    routeUrl = "{{ route('admin.orders.status', ['status' => ':status']) }}";
                    routeUrl = routeUrl.replace(':status', encodeURIComponent(status));
                }
                window.location.href = routeUrl; // redirect
            });
        });
    </script>
@endpush
