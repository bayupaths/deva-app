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
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title mb-0">Tabel Pemesanan</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="orders-table" class="table table-hover my-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Tanggal Order</th>
                                        <th>Konsumen</th>
                                        <th>Produk</th>
                                        <th>Total Order</th>
                                        <th>Status Order</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $item)
                                    <tr>
                                        <td>{{ $item->order->order_code }}</td>
                                        <td>{{ $item->order->order_date }}</td>
                                        <td>{{ $item->order->user->name }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->order->total_price }}</td>
                                        @php
                                            $statusColor = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->order->order_status);
                                        @endphp
                                        <td><a href="#"><span class="badge {{ $statusColor }}">{{ $item->order->order_status }}</a></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">
                                                <i data-feather="chevron-right" class="feather-14"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse
                                    <tr>
                                        <td>ORD1234-20231212</td>
                                        <td>12-12-2023</td>
                                        <td>John</td>
                                        <td>Banner</td>
                                        <td>Rp. 50.000,-</td>
                                        <td><a href="#"><span class="badge bg-secondary">Pending</a></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">
                                                <i data-feather="chevron-right" class="feather-14"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ORD1234-20231212</td>
                                        <td>12-12-2023</td>
                                        <td>John</td>
                                        <td>Banner</td>
                                        <td>Rp. 50.000,-</td>
                                        <td><a href="#"><span class="badge bg-warning">Diproses</a></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">
                                                <i data-feather="chevron-right" class="feather-14"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ORD1234-20231212</td>
                                        <td>12-12-2023</td>
                                        <td>John</td>
                                        <td>Banner</td>
                                        <td>Rp. 50.000,-</td>
                                        <td><a href="#"><span class="badge bg-success">Selesai</a></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">
                                                <i data-feather="chevron-right" class="feather-14"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ORD1234-20231212</td>
                                        <td>12-12-2023</td>
                                        <td>John</td>
                                        <td>Banner</td>
                                        <td>Rp. 50.000,-</td>
                                        <td><a href="#"><span class="badge bg-danger">Dibatalkan</a></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">
                                                <i data-feather="chevron-right" class="feather-14"></i>
                                            </a>
                                        </td>
                                    </tr>
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
