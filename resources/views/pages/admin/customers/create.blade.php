@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Form Tambah Konsumen</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}"
                            class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="text-decoration-none">
                            Konsumen</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Konsumen</li>

                </ol>
            </nav>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="customerName" class="form-label">Nama Konsumen</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="customerName" name="name" value="{{ old('name') }}"
                                        placeholder="Masukan nama konsumen">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="customerEmail" class="form-label">Alamat Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="customerEmail" name="email" value="{{ old('email') }}"
                                        placeholder="Masukan alamat email konsumen">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="customerPhone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="customerPhone" name="phone_number" value="{{ old('phone_number') }}"
                                        placeholder="Masukan nomor telepon">
                                    @error('phone_number')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="customerAddress" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="customerAddress" name="address"
                                        placeholder="Masukan alamat konsumen">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="customerPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="customerPassword" name="password" value="{{ old('password') }}"
                                        placeholder="Masukan password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
