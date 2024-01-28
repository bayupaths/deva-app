@extends('layouts.app')

@section('content')
    <div class="page-profile">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="profile-customer" data-aos="fade-down" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <ul class="list-group">
                            <a href="{{ route('order.history') }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Riwayat Order
                                    <span class="badge bg-primary rounded-pill">{{ $orders }}</span>
                                </li>
                            </a>
                            <a href="{{ route('order.invoice') }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Invoice
                                    <span class="badge bg-primary rounded-pill">{{ count($invoices) }}</span>
                                </li>
                            </a>
                        </ul>
                    </div>

                    <div class="col-md-8 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Invoice</h5>
                            </div>
                            <div class="card-body h-100">
                                <div class="table-responsive">
                                    <table id="history-order-table" class="table table-sm table-hover my-0"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tanggal</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->invoice_number }}</td>
                                                    <td>{{ $invoice->invoice_date }}</td>
                                                    <td>{{ $invoice->due_date ?? '-' }}</td>
                                                    <td>Rp. {{ number_format($invoice->total_amount) }}</td>
                                                    <td>
                                                        <a href="{{ route('invoice.show', $invoice->invoice_number) }}">
                                                            <span
                                                                class="badge {{ $invoice->status == 'UNPAID' ? 'bg-danger' : 'bg-success' }}">
                                                                {{ $invoice->status }}
                                                            </span>
                                                        </a>
                                                    </td>
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
            </div>
        </section>
    </div>
@endsection
