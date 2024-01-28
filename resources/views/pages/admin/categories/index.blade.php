@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Kategori Produk</h1>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title mb-0 flex-grow-1">Tabel Kategori Produk</h5>
                        <a href="{{ route('category.create') }}" class="btn btn-primary mb-0">
                            + Tambah Kategori Baru
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categories-table" class="table table-striped table-borderless" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">No</th>
                                        {{-- <th style="width: 15%">Image</th> --}}
                                        <th style="width: 20%">Nama</th>
                                        <th style="width: 20%">Slug</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $increment = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $increment++ }}</td>
                                            {{-- <td>
                                                <img src="{{ Storage::url($category->image) }}" class="img-fluid"
                                                    style="width: 70px" alt="...">
                                            </td> --}}
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td class="text-center">
                                                <div class="d-flex">
                                                    <a href="{{ route('category.edit', $category->slug) }}"
                                                        class="btn btn-sm btn-success">
                                                        <i data-feather="edit" class="feather-14" data-toggle="tooltip"
                                                            title="Edit" data-placement="top"></i>
                                                    </a>
                                                    <form action="{{ route('category.destroy', $category->id) }}"
                                                        method="post">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                            class="delete-category-{{ $category->id }}"
                                                            style="display: none"></button>
                                                        <button type="button"
                                                            onclick="return confirmDelete({{ $category->id }})"
                                                            class="btn btn-sm btn-danger delete-category">
                                                            <i data-feather="trash-2" class="feather-14"
                                                                data-toggle="tooltip" title="Hapus"
                                                                data-placement="top"></i>
                                                        </button>
                                                    </form>
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
                title: 'Hapus Kategori Produk',
                text: 'Anda akan menghapus data kategori produk. Tindakan ini tidak dapat dibatalkan.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    var confirmClass = 'delete-category-' + id;
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
