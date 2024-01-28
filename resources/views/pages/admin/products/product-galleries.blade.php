@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
@endpush

@section('content')
    <div class="section-content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3 dashboard-title">Galeri Produk</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}"
                            class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}"
                            class="text-decoration-none">Produk</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri Produk</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="productName">Nama Produk</label>
                            <input class="form-control form-control-lg" id="productName" type="text" name="name"
                                value="{{ $product->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="category">Kategori</label>
                            <input class="form-control form-control-lg" id="category" type="text" name="name"
                                value="{{ $product->categories->name }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-2">
                                <h5 class="fw-bold">Galeri Produk</h5>
                            </div>
                            @forelse ($product->galleries as $gallery)
                                <div class="col-md-4">
                                    <div class="image-container">
                                        <img src="{{ Storage::url($gallery->file_path ?? '') }}" alt=""
                                            class="w-100" />
                                        <div class="overlay"></div>
                                        <div class="delete-icon"
                                            onclick="deletePhoto('{{ route('galleries.delete', ['id' => $gallery->id]) }}')">
                                            <i data-feather="trash"></i>
                                            <span>Hapus Gambar</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="mb-2 justify-content-center">
                                    <p class="text-center">No image available</p>
                                </div>
                            @endforelse
                            <label class="form-label fw-bold" for="images">Tambah Foto Produk</label>
                            <form action="{{ route('galleries.store') }}" method="post" enctype="multipart/form-data"
                                id="form-upload">
                                @csrf
                                <input type="hidden" name="product_uuid" value="{{ $product->uuid }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="input-data">
                                </div>
                                <div class="form-group">
                                    <div class="needsclick dropzone" id="document-dropzone"></div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('prepend-script')
    <script src="{{ url('/vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
    <script type="text/javascript">
        var uploadedDocumentMap = {};
        Dropzone.options.documentDropzone = {
            url: "{{ route('galleries.upload') }}",
            paramName: "file",
            maxFilesize: 2,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                product_id: document.querySelector('input[name="product_id"]').value
            },
            success: function(file, response) {
                console.log(response);
                $('form').append('<input type="hidden" name="file_name[]" value="' + response.file_name +
                    '">');
                $('form').append('<input type="hidden" name="file_type[]" value="' + response.file_type +
                    '">');
                $('form').append('<input type="hidden" name="file_size[]" value="' + response.file_size +
                    '">');
                $('form').append('<input type="hidden" name="file_path[]" value="' + response.file_path +
                    '">');
                uploadedDocumentMap[file.name] = response.file_name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                formUpload.find('input[name="file_name[]"][value="' + file_name + '"]').remove();
                formUpload.find('input[name="file_type[]"][value="' + file_type + '"]').remove();
                formUpload.find('input[name="file_size[]"][value="' + file_size + '"]').remove();
                formUpload.find('input[name="file_path[]"][value="' + file_path + '"]').remove();
            },

            // removedfile: function(file) {
            //     var _ref;
            //     return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
            //         void 0;
            // }
        }

        function deletePhoto(routeUrl) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Foto',
                text: 'Anda akan menghapus foto produk. Tindakan ini tidak dapat dibatalkan.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(routeUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error('Gagal menghapus foto.');
                            }
                        })
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                            });
                            window.location.reload();
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error.message,
                            });
                        });
                } else {
                    Swal.fire(
                        'Dibatalkan',
                        'Hapus data kategori produk dibatalkan.',
                        'info'
                    );
                }
            })
        }
    </script>
@endpush
