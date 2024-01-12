@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Konsumen</h1>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Konsumen</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title mb-0 flex-grow-1">Tabel Konsumen</h5>
                        <a href="{{ route('customer.create') }}" class="btn btn-primary mb-0">
                            + Tambah Konsumen Baru
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categories-table" class="table table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">ID</th>
                                        <th style="width: 10%">Foto</th>
                                        <th style="width: 20%">Nama</th>
                                        <th style="width: 15%">Email</th>
                                        <th style="width: 15%">Telepon</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->user_id }}</td>
                                            <td> <img
                                                    src="{{ $user->photos ? Storage::url($user->photos) : url('/assets/images/profile/default-user-icon.png') }}"
                                                    class="img-fluid" style="width: 70px" alt="Foto Profile">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td class="text-center">
                                                <div class="d-flex">
                                                    <a href="{{ route('customer.show', $user->user_id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i data-feather="info" class="feather-14" data-toggle="tooltip"
                                                            title="Show" data-placement="top"></i>
                                                    </a>
                                                    <form action="{{ route('customer.destroy', $user->user_id) }}"
                                                        method="post">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="delete-customer-{{ $user->user_id }}"
                                                            style="display: none"></button>
                                                        <button type="button" onclick="return confirmDelete({{ $user->user_id }})"
                                                            class="btn btn-sm btn-danger delete-customer">
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
                title: 'Hapus Konsumen',
                text: 'Anda akan menghapus data konsumen. Tindakan ini tidak dapat dibatalkan.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    var confirmClass = 'delete-customer-' + id;
                    var deleteButton = document.querySelector('.' + confirmClass);
                    if (deleteButton) {
                        deleteButton.click();
                    }
                } else {
                    Swal.fire(
                        'Dibatalkan',
                        'Hapus data konsumen dibatalkan.',
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
