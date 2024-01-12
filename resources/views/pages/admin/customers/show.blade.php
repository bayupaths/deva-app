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

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Profile Konsumen</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('customer.index') }}" class="text-decoration-none">Konsumen</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Konsumen</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Detail Profile</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $customer->photos ? Storage::url($customer->photos) : url('/assets/images/profile/default-user-icon.png') }}"
                            alt="{{ $customer->name }}" class="img-fluid rounded-circle mb-2" width="128"
                            height="128" />
                        <h5 class="card-title mb-0">{{ $customer->name }}</h5>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Tentang</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <span data-feather="mail" class="feather-sm me-1"></span> Email <br>
                                <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
                            </li>
                            <li class="mb-1">
                                <span data-feather="phone" class="feather-sm me-1"></span> Telepon <br>
                                <a href="#">{{ $customer->phone_number }}</a>
                            </li>
                            <li class="mb-1">
                                <span data-feather="home" class="feather-sm me-1"></span> Alamat <br>
                                <a href="#">{{ $customer->address }}</a>
                            </li>
                            <li class="mb-1">
                                <span data-feather="user" class="feather-sm me-1"></span> Status
                                <a class="badge {{ $customer->status == 'active' ? 'bg-success' : 'bg-danger' }}"
                                    href="#">{{ $customer->status == 'active' ? 'Aktif' : 'Non Aktif' }}</a>
                            </li>
                        </ul>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Update Konsumen</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <form id="customerStatusForm"
                                    action="{{ route('update.customer.status', $customer->user_id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <span data-feather="user" class="feather-sm me-1"></span> Status Konsumen
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="customerStatus" name="status"
                                            {{ $customer->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="customerStatus">{{ $customer->status == 'active' ? 'Aktif' : 'Non Aktif' }}</label>
                                    </div>
                                    <!-- Tambahkan tombol submit yang tersembunyi untuk diklik menggunakan JavaScript -->
                                    <button type="submit" id="submitBtn" style="display: none;">Simpan Perubahan</button>
                                </form>
                            </li>
                            <li class="mb-1">
                                <span data-feather="edit" class="feather-sm me-1"></span> Data Konsumen
                                <a href="{{ route('customer.edit', $customer->user_id) }}" class="btn btn-sm btn-success">
                                    <i data-feather="edit" class="feather-14" data-toggle="tooltip" title="Edit"
                                        data-placement="top"></i>
                                </a>
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
            var ordersTable = document.querySelector('#history-order-table');
            let dataTables = new DataTable(ordersTable, {
                responsive: true
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const customerStatusToggle = document.getElementById('customerStatus');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('customerStatusForm');

            customerStatusToggle.addEventListener('change', function() {
                form.submit();
            });
        });
    </script>
@endpush
