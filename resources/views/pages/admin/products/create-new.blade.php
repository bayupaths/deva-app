@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ url('vendor/ckeditor5/css/sample.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Form Tambah Kategori Produk</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product.index') }}" class="text-decoration-none">Produk</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
                </ol>
            </nav>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold" for="productName">Nama Produk</label>
                                    <input id="productName" type="text" name="name"
                                        class="form-control form-control-lg  @error('name') is-invalid @enderror"
                                        placeholder="Masukan nama produk" spellcheck="false" data-ms-editor="true"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productDescription" class="form-label fw-bold">Deskripsi</label>
                                    <textarea id="productDescription" class="form-control @error('description') is-invalid @enderror" name="description"
                                        placeholder="Masukan deskripsi produk">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="card mb-4">
                            <!-- card body -->
                            <div class="card-body">
                                {{-- <!-- input -->
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock"
                                    checked="">
                                <label class="form-check-label" for="flexSwitchStock">In Stock</label>
                            </div>
                            <!-- input --> --}}
                                <div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="productCategory" class="form-label fw-bold">Kategori</label>
                                            <a href="{{ route('category.create') }}" class="btn-link fw-semi-bold">Tambah</a>
                                        </div>
                                        <select name="category" id="productCategory"
                                            class="form-control @error('category') is-invalid @enderror" required>
                                            <option value="" disabled selected>Pilih kategori produk</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3">
                                        <label for="productPrice" class="form-label fw-bold">Harga</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            id="productPrice" name="price" value="{{ old('price') }}"
                                            placeholder="Masukan harga produk">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="productStcok" class="form-label fw-bold">Stok</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                            id="productStcok" name="stock" value="{{ old('stock') }}"
                                            placeholder="Masukan stok produk">
                                        @error('stock')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="form-submit-button">
                                Create Product
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('prepend-script')
    <script src="/vendor/ckeditor5/js/ckeditor.js"></script>
    <script src="/vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#productDescription'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
    <script type="text/javascript">
        var $form = $('#form-product');
        $method = $form.attr('method');
        $url = $form.attr('action');

        // Disable AutoDiscover
        Dropzone.autoDiscover = false;

        // Set Dropzone Options
        Dropzone.options.myAwesomeDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 20,
            maxFiles: 20,
            addRemoveLinks: true,
            acceptedFiles: ".jpg, .jpeg, .png",
            maxFilesize: 2, // 2MB
            dictDefaultMessage: "Drop your files here!",
        };

        // Initialize Dropzone
        var myDropzone = new Dropzone("#myAwesomeDropzone", {
            url: $url,
            method: $method
        });

        // Initialize Submit Button
        var submitButton = document.querySelector("#form-submit-button");

        // Submit Button Event on click
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            myDropzone.processQueue();
        });

        // on sending via dropzone append token and form values (using serializeObject jquery Plugin)
        myDropzone.on("sendingmultiple", function(file, xhr, formData) {
            var formValues = $('#form-product').serializeObject();
            $.each(formValues, function(key, value) {
                formData.append(key, value);
            });
        });

        // on success redirect
        myDropzone.on("successmultiple", function() {
            // redirect to products page after success.
            window.location = "{{ route('product.index') }}";
        });

        // on error show errors
        myDropzone.on("errormultiple", function(file, errorMessage, xhr) {
            var arr = [];
            $.each(errorMessage, function(key, value) {
                console.log(value);
                arr += value + "\n";
            });
            // show error message
            console.log(arr);
        });
    </script>
@endpush

