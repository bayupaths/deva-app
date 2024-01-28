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
            border: 0;
            border-top: 1px solid #ddd;

        }

        .table {
            width: 100%;
            color: #212529;
            margin: 1rem -1.5rem;
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
        <section class="invoice">
            <div class="container">
                <div class="card">
                    <div class="card-body m-sm-2 m-md-5">
                        <div class="row">
                            <div class="col">
                                <img src="{{ public_path('/assets/images/deva-logo.png') }}" alt=""
                                    width="150">
                            </div>
                            <div class="col text-md-end">
                                <strong>Invoice: #TRX-3131313141</strong>
                                <div class="text-muted">Creation Date : </div>
                                <div class="text-muted">Status : </div>

                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col">
                                <div class="text-muted">Payment No.</div>
                                <strong>741037024</strong>
                            </div>
                            <div class="col text-md-end">
                                <div class="text-muted">Payment Date</div>
                                <strong>June 2, 2023 - 03:45 pm</strong>
                            </div>
                        </div>

                        <hr class="my-4">


                        <div class="row">
                            <div class="col">
                                <div class="text-muted">Customer</div>
                                <strong>
                                    Charles Hall
                                </strong>
                                <p>
                                    4183 Forest Avenue <br>
                                    New York City <br>
                                    10011 <br>
                                    USA <br>
                                    <a href="#">
                                        chris.wood@gmail.com
                                    </a>
                                </p>
                            </div>
                            <div class="col text-md-end">
                                <div class="text-muted">Payment To</div>
                                <strong>
                                    AdminKit Demo LLC
                                </strong>
                                <p>
                                    354 Roy Alley <br>
                                    Denver <br>
                                    80202 <br>
                                    USA <br>
                                    <a href="#">
                                        info@adminkit.com
                                    </a>
                                </p>
                            </div>
                        </div>

                        <hr class="my-4">

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
                                    <td>AdminKit Demo Theme Customization</td>
                                    <td>2</td>
                                    <td class="text-end">$150.00</td>
                                </tr>
                                <tr>
                                    <td>Monthly Subscription </td>
                                    <td>3</td>
                                    <td class="text-end">$25.00</td>
                                </tr>
                                <tr>
                                    <td>Additional Service</td>
                                    <td>1</td>
                                    <td class="text-end">$100.00</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Subtotal </th>
                                    <th class="text-end">$275.00</th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Total </th>
                                    <th class="text-end">$2128.85</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
