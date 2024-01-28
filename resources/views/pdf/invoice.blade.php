<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 0px;
        }

        /* Reset some default styles */
        body,
        h1,
        h2,
        h3,
        p,
        ul,
        ol,
        li {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0px;
            font-size: 14px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        strong {
            font-weight: bold;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .card-body {
            padding: 0 1.5rem;
            font-size: 12px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 1rem -1.5rem;
            padding: 0 1.5rem;
        }

        .col {
            flex: 1;
            padding: 0 1.5rem;
        }

        .text-md-end {
            text-align: right;
        }

        .text-muted {
            color: #888;
        }

        hr {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            padding: 0 1.5rem;
            border: 0;
            border-top: 1px solid #ddd;
        }

        .table {
            width: 100%;
            color: #212529;
            margin: 0 auto;
            padding: 0 1.5rem;
            font-size: 12px;
        }

        .table th,
        .table td {
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #dee2e6;
        }


        /* Your specific styling for the invoice */
        #invoice {
            /* background-color: #f8f9fa; */
            padding: 1rem 0;
        }

        .invoice {
            /* background-color: #ffffff; */
            /* box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); */
            border-radius: 10px;
        }

        .payment-status {
            position: fixed;
            bottom: 550px;
            left: 200px;
            z-index: 10000;
            font-size: 100px;
            transform: rotate(-30deg);
            opacity: 0.6;
        }

        /* Adjustments for printing */
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            #invoice {
                width: 100%;
            }

            .card {
                border: none;
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
    <title>Invoice#</title>
</head>

<body>
    <div id="invoice">

        <div class="payment-status" style="color: {{ $invoice->status === 'UNPAID' ? 'red' : 'green' }}">
            {{ $invoice->status }}
        </div>

        <section class="invoice">
            <div class="container">
                <div class="card">
                    <div class="card-body m-sm-2 m-md-5">
                        <div class="row">
                            <div class="col">
                                <img src="{{ public_path('/assets/images/deva-logo.png') }}" alt=""
                                    width="170">
                            </div>
                            <div class="col text-md-end">
                                <h3 style="font-weight: bold;">Deva Digital Print</h3>
                                <strong>Pusat Stempel Express</strong>
                                <div class="text-muted">Jl. Lembuayu RT 002/003 Susukan</div>
                                <div class="text-muted">Sumbang, Banyumas, Jawa Tengah 53183</div>
                                <div class="text-muted">082243378269</div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <h3 style="font-weight: bold;">Invoice#<strong>{{ $invoice->invoice_number }}</strong></h3>
                                <div class="text-muted">Invoice Date : {{ $invoice->invoice_date }}</div>
                                <div class="text-muted">Due Date : {{ $invoice->due_date ?? '' }}</div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <h3 style="font-weight: bold;">Invoice To</h3>
                                <strong>{{ $invoice->orders->users->name }}</strong>
                                <div class="text-muted">{{ $invoice->orders->users->address ?? '' }} </div>
                                <div class="text-muted">{{ $invoice->orders->users->country ?? 'Indonesia' }}</div>
                                <div class="text-muted">{{ $invoice->orders->users->phone_number ?? '' }}</div>
                            </div>
                        </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-end">{{ $items->products->name }}</td>
                                    <td class="text-end">{{ $items->product_quantity }}</td>
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

                        <div class="row">
                            <div class="col">
                                <h3 style="font-weight: bold;">Transaction</h3>
                            </div>
                        </div>
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

                        <div style="text-align: center; margin-top: 3rem;">
                            <p>
                                Pdf Generate at <strong>{{ now()->format('d/m/Y') }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
