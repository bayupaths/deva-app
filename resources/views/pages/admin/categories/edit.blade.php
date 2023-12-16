@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <style>
        /* Efek Hover pada Gambar Baru */
        #preview:hover {
            transform: scale(1.1);
            /* Membesar ketika dihover */
            transition: transform 0.3s ease;
            /* Efek transisi ketika hover */
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Form Update Kategori Produk</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}"
                            class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}" class="text-decoration-none">Kategori
                            Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Kategori Produk</li>

                </ol>
            </nav>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('category.update', $category->category_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="slug" value="{{ $category->slug }}">
                                <div class="mb-3 form-group">
                                    <label for="categoryName" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="categoryName" name="name" value="{{ $category->name }}"
                                        placeholder="Masukan nama kategori produk">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                {{-- <div class="mb-3 form-group">
                                <label for="descriptionCategory" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="descriptionCategory" name="description"
                                    placeholder="Masukan deskripsi kategori">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div> --}}
                                <div class="mb-3">
                                    <label for="categoryImage" class="form-label">Foto Kategori</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        id="categoryImage" name="image" onchange="previewImage(this)">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="preview" class="form-label">Preview Gambar Baru</label>
                                    <img id="preview" class="img-fluid w-25" alt="Preview Gambar" style="display: none;">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endpush
