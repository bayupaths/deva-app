@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Produk</h1>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title mb-0 flex-grow-1">Tabel Produk</h5>
                        <a href="{{ route('product.create') }}" class="btn btn-primary mb-0">
                            + Tambah Produk Baru
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categories-table" class="table table-striped table-borderless" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">ID</th>
                                        <th style="width: 15%">Nama</th>
                                        <th style="width: 20%">Kategori</th>
                                        <th style="width: 20%">Harga</th>
                                        <th style="width: 20%">Stok</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $increment = 1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $increment++ }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->categories->name }}</td>
                                            <td>Rp. {{ number_format($product->price) }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('product.show', $product->uuid) }}" class="btn btn-primary">Detail</a>
                                                    <button type="button"
                                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="visually-hidden">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('product.galleries', $product->uuid) }}">Galeri</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{ route('product.specs', $product->uuid) }}">Spesifikasi</a></li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <form action="{{ route('product.destroy', $product->uuid) }}"
                                                            method="post">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" id="delete-product-{{ $product->uuid }}"
                                                                style="display: none"></button>
                                                            <li><a class="dropdown-item delete-product"
                                                                    onclick="return confirmDelete({{ $product->uuid }})" href="#">
                                                                    Hapus Produk
                                                                </a>
                                                            </li>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
        function confirmDelete(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Produk',
                text: 'Anda akan menghapus data produk. Tindakan ini tidak dapat dibatalkan.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    var confirmClass = 'delete-product-' + id;
                    var deleteButton = document.querySelector('.' + confirmClass);
                    if (deleteButton) {
                        deleteButton.click();
                    }
                } else {
                    Swal.fire(
                        'Dibatalkan',
                        'Hapus data kategori produk dibatalkan.',
                        'info'
                    );
                }
            })
        }

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
