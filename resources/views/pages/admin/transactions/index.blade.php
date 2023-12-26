@extends('layouts.admin')

@section('title')
    Admin Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar Transaksi Pembayaran</h1>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title mb-0">Tabel Invoice</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="orders-table" class="table table-hover my-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Kode Invoice</th>
                                        <th>Kode Order</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Konsumen</th>
                                        <th>Metode Bayar</th>
                                        <th>Total Bayar</th>
                                        <th>Status Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV1234-20231217</td>
                                        <td>ORD1234-20231212</td>
                                        <td>17-12-2023</td>
                                        <td>Mrs. Adela Beahan</td>
                                        <td>Transfer Bank</td>
                                        <td>Rp. 150.000,-</td>
                                        <td><a href="#"><span class="badge bg-secondary">UNPAID</a></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">
                                                <i data-feather="chevron-right" class="feather-14"></i>
                                            </a>
                                        </td>
                                     </tr>
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
