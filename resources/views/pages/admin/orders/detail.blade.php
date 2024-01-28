@extends('layouts.admin')

@section('title')
    Deva Digital Print -
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar Pemesanan</h1>
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard-admin') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-7 col-xxl-9 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-1">Order ID: {{ $item->orders->order_code }}</h4>
                                <div class="d-flex align-items-center">
                                    <small>Tanggal Order:
                                        {{ Carbon\Carbon::parse($item->orders->order_date)->format('d F Y, H:i') ?? '' }}</small>

                                    @if ($item->invoices)
                                        @php
                                            $colorPayment = \App\Providers\OrderHelperProvider::getPaymentStatusColor($item->invoices->status);
                                        @endphp
                                        <span class="badge {{ $colorPayment }} ms-2">{{ $item->invoices->status }}</span>
                                    @else
                                        <span class="badge bg-secondary ms-2">Unpaid</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <a href="#!" class="btn btn-primary">Invoice</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table text-nowrap mb-0 table-centered">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Items</th>
                                        <th scope="col">Amounts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('product.show', $item->products->slug) }}">
                                                    <img src="{{ Storage::url($item->products->galleries->first()->file_path ?? '') }}"
                                                        alt="{{ $item->products->galleries->first()->file_name }}"
                                                        class="img-thumbnail mx-auto d-block rounded-3" width="100px">
                                                </a>
                                                <div class="ms-3">
                                                    <h5 class="mb-0">
                                                        <a href="{{ route('product.show', $item->products->slug) }}"
                                                            class="text-inherit">{{ $item->products->name }}</a>
                                                    </h5>
                                                    <small>Kategori : {{ $item->products->categories->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp. {{ number_format($item->product_price) }}</td>
                                        <td>{{ $item->product_quantity }}</td>
                                        <td>Rp. {{ number_format($item->subtotal) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-1">Detail Order</h4>
                                <div class="d-flex align-items-center">
                                    <small>Status Order : </small>
                                    @php
                                        $colorStatus = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->orders->order_status);
                                    @endphp
                                    <span class="badge {{ $colorStatus }} ms-2">{{ $item->orders->order_status }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex align-items-center">
                                <input type="hidden" id="orderId" value="{{ $item->orders->id }}">
                                <label class="form-label me-4 mb-0">Status</label>
                                <select class="form-select" aria-label="Default select example" id="orderStatus">
                                    <option value="PENDING">Pending</option>
                                    <option value="PROCESSED">Diproses</option>
                                    <option value="FINISHED">Selesai</option>
                                    <option value="CANCELED">Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Produk: {{ $item->products->name }}</h5>
                        <p class="card-text">
                            <strong>Spesifikasi Produk:</strong><br>
                            @forelse ($item->specifications()->get() as $spec)
                                - {{ $spec->name }} :
                                {{ $spec->spec_value . $spec->unit != null ? "($spec->unit)" : '' }} <br>
                            @empty
                                - (kosong)
                            @endforelse
                        </p>
                        <p class="card-text">
                            <strong>Detail Order:</strong><br>
                            - Jumlah: {{ $item->product_quantity }} pcs<br>
                            - Total Harga: Rp. {{ number_format($item->subtotal) }}<br>
                            - Tanggal Pemesanan:
                            {{ Carbon\Carbon::parse($item->orders->order_date)->format('d F Y') ?? '' }}<br>
                        </p>
                        <p class="card-text">
                            <strong>Catatan Pembeli:</strong><br>
                            {!! $item->order_note ?? '-' !!}
                        </p>
                        <p class="card-text">
                            <strong>Gambar Desain:</strong><br>

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xxl-3 col-12">
                <div class="card mb-4 mt-4 mt-lg-0">
                    <div class="card-header">
                        <h4 class="mb-0">Customer Info</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between">
                                <span>Nama</span>
                                <span class="text-dark">{{ $item->orders->users->name }}</span>
                            </li>
                        </ul>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between">
                                <span>Telepon</span>
                                <span class="text-dark">{{ $item->orders->users->phone_number }}</span>
                            </li>
                        </ul>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between">
                                <span>Email</span>
                                <span class="text-dark">{{ $item->orders->users->email }}</span>
                            </li>
                        </ul>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between">
                                <span>Alamat</span>
                                <span class="text-dark">{{ $item->orders->users->addess }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 p-0">Invoice Info</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-2">
                                <span>Invoice Number:</span>
                                <span class="text-dark">
                                    {{ $item->orders->invoices !== null ? $item->orders->invoices->invoice_number : '-' }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span>Invoice Date:</span>
                                <span class="text-dark">
                                    {{ $item->orders->invoices !== null ? $item->orders->invoices->invoice_date : '-' }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span>Due Date:</span>
                                <span class="text-dark">
                                    {{ $item->orders->invoices !== null ? $item->orders->invoices->due_date : '-' }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span>Method</span>
                                <span class="text-dark">
                                    {{ $item->orders->invoices !== null ? $item->orders->invoices->payment_method : '-' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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

    <script>
        const orderStatusSelect = document.getElementById('orderStatus');
        const orderIdInput = document.getElementById('orderId');

        orderStatusSelect.addEventListener('change', () => {
            const orderStatusValue = orderStatusSelect.value;
            const orderId = orderIdInput.value;
            const url = "{{ route('updateOrderStatus') }}";

            // Send a request to Laravel to update the order status
            axios.post(url, {
                    orderId: orderId,
                    orderStatus: orderStatusValue
                })
                .then(response => {
                    Swal.fire({
                        title: 'Success',
                        text: response.data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Refresh the page
                        location.reload();
                    });
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
@endpush
