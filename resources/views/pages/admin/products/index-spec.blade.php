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
                        <h4 class="mb-4 fw-bold">Spesifikasi Produk</h4>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="mb-4 fw-bold">Spesifikasi Produk</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
