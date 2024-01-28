@extends('layouts.admin')

@section('title')
    Dashboard Admin Deva Digital Print
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Spesifikasi Produk Produk</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product.index') }}" class="text-decoration-none">Produk</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Spesifikasi Produk</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-8 lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 class="mb-4">Spesifikasi Produk</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 8%">ID</th>
                                            <th style="width: 15%">Spesifikasi</th>
                                            <th style="width: 15%">Nilai</th>
                                            <th style="width: 20%">Unit</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $increment = 1;
                                        @endphp
                                        @forelse ($product->specifications as $spec)
                                            <tr>
                                                <td>{{ $increment++ }}</td>
                                                <td>{{ $spec->name }}</td>
                                                <td>{{ $spec->spec_value }}</td>
                                                <td>{{ $spec->unit }}</td>
                                                <td>-</td>
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
            <div class="col-lg-4 col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 class="mb-4">Tambah Spesifikasi Produk</h4>
                            <form action="{{ route('specifications.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="mb-3 form-group">
                                    <label for="specProduct" class="form-label">Spesifikasi Produk</label>
                                    <select name="spec_type" id="specProduct"
                                        class="form-control @error('spec_type') is-invalid @enderror">
                                        <option value="" selected>Pilih Spesifikasi produk</option>
                                        @foreach ($product->specifications->unique('spec_type') as $specType)
                                            <option value="{{ $specType->spec_type }}">{{ $specType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('spec_type')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="specName" class="form-label">Tambah Spesifikasi</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="specName" name="name" value="{{ old('name') }}"
                                        placeholder="Masukan jenis spesifikasi">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="specValue" class="form-label">Nilai Spesifikasi</label>
                                    <input type="text" class="form-control @error('spec_value') is-invalid @enderror"
                                        id="specValue" name="spec_value" value="{{ old('spec_value') }}"
                                        placeholder="Masukan nilai spesifikasi">
                                    @error('spec_value')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="specUnit" class="form-label">Unit / Satuan</label>
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                        id="specUnit" name="unit" value="{{ old('unit') }}"
                                        placeholder="Masukan satuan spesifikasi">
                                    @error('unit')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var specTypeSelect = document.getElementById('specProduct');
            var nameInput = document.getElementById('specName');

            specTypeSelect.addEventListener('change', function() {
                var specType = this.value;

                // Menggunakan route() untuk mendapatkan URL dari route
                var url = "{{ route('getSpecName', ':specType') }}";
                url = url.replace(':specType', specType);

                // Membuat objek XMLHttpRequest
                var xhr = new XMLHttpRequest();

                // Mengatur callback ketika permintaan selesai
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Mengupdate nilai elemen input dengan 'name' yang didapat
                        var data = JSON.parse(xhr.responseText);
                        nameInput.value = data.name;

                        // Mengatur elemen input sebagai readonly
                        nameInput.setAttribute('readonly', true);
                    } else if(xhr.status === 404) {
                        nameInput.value = '';
                        nameInput.removeAttribute('readonly');
                        console.error('Request failed. Status: ' + xhr.status);
                    } else {
                        console.error('Request failed. Status: ' + xhr.status);
                    }
                };

                // Mengatur jenis permintaan dan URL
                xhr.open('GET', url, true);

                // Melakukan permintaan
                xhr.send();
            });
        });
    </script>
@endpush
