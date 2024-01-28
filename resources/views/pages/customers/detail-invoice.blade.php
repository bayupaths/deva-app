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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('order.invoice') }}">Invoice</a>
                                </li>
                                <li class="breadcrumb-item active">Detail Invoice</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="invoice" data-aos="fade-down" data-aos-delay="200">
            <div class="container">
                <div class="card m-auto" style="width: 64rem;">
                    <div class="card-body m-sm-2 m-md-5">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="/assets/images/deva-logo.png" alt="" width="250">
                            </div>
                            <div class="col-md-6 text-md-end">
                                <strong>Invoice: #{{ $invoice->invoice_number }}</strong>
                                <div class="text-muted">Creation Date : {{ $invoice->invoice_date }} </div>
                                <div class="text-muted">Due Date : {{ $invoice->due_date ?? '-' }} </div>
                                <div class="text-muted">Status :
                                    <span
                                        class="{{ $invoice->status == 'UNPAID' ? 'text-danger' : 'text-success' }}">{{ $invoice->status }}</span>
                                </div>
                                <div class="text-muted">Payment Method : {{ $invoice->payment_method ?? '-' }} </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="text-muted">Customer</div>
                                <strong>
                                    {{ $invoice->orders->users->name }}
                                </strong>
                                <p>
                                    {{ $invoice->orders->users->address ?? '' }} <br>
                                    {{ $invoice->orders->users->country ?? 'Indonesia' }} <br>
                                    {{ $invoice->orders->users->phone_number ?? '' }} <br>
                                    <a
                                        href="mailto:{{ $invoice->orders->users->email }}">{{ $invoice->orders->users->email }}</a>
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="text-muted">Payment To</div>
                                <strong>
                                    Deva Digital Print
                                </strong>
                                <p>
                                    Jl. Lembuayu RT 002/003 Susukan <br>
                                    Sumbang, Banyumas, <br>
                                    Jawa Tengah 53183 <br>
                                    082243378269 <br>
                                </p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $items->products->name }}</td>
                                    <td>{{ $items->product_quantity }}</td>
                                    <td class="text-end">Rp. {{ number_format($items->product_price) }}</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Subtotal </th>
                                    <td class="text-end">Rp. {{ number_format($items->subtotal) }}</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Total </th>
                                    <td class="text-end">Rp. {{ number_format($invoice->orders->total_price) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr class="my-4">

                        <strong>Transactions</strong>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Gateway</th>
                                    <th>Transaction ID</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoice->payments as $payment)
                                    <tr>
                                        <td class="text-end">{{ $payment->payment_date ?? '' }}</td>
                                        <td class="text-end">{{ $payment->payment_method ?? '' }}</td>
                                        <td class="text-end">{{ $payment->transaction_reference ?? '' }}</td>
                                        <td class="text-end">Rp.
                                            {{ number_format($payment->payment_amount) ?? '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-end">-</td>
                                        <td class="text-end">-</td>
                                        <td class="text-end">-</td>
                                        <td class="text-end">-</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-center">
                            @if ($invoice->payment_method == 'transfer' && $invoice->status == 'UNPAID')
                                <a href="{{ route('payment.create', $invoice->invoice_number) }}"
                                    class="btn btn-success">Bayar</a>
                            @endif
                            <a href="{{ route('invoice.print', $invoice->invoice_number) }}" class="btn btn-outline-secondary">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
