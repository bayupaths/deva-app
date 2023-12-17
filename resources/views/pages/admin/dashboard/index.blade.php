@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Dashboard Admin</h1>
        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Penjualan</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">2.382</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Konsumen</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">14.212</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Pendapatan</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">Rp. 21.300</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Pesanan</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">64</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Transaksi Terkini</h5>
                    </div>
                    <div class="card-body py-3">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Kode Invoice</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TRX202123131131</td>
                                    <td>15-12-2023</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td>Rp. 150.000</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>TRX202123131131</td>
                                    <td>15-12-2023</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td>Rp. 150.000</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>TRX202123131131</td>
                                    <td>15-12-2023</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td>Rp. 150.000</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>TRX202123131131</td>
                                    <td>15-12-2023</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td>Rp. 150.000</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>TRX202123131131</td>
                                    <td>15-12-2023</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td>Rp. 150.000</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Daftar Pesanan</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Kode Order</th>
                                    <th>Tanggal Order</th>
                                    <th>Produk</th>
                                    <th>Konsumen</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentOrders as $item)
                                    <tr>
                                        <td>{{ $item->order->order_code }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->order->order_date)->format('d F Y') ?? '' }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->order->user->name }}</td>
                                        @php
                                            $statusColor = \App\Providers\OrderHelperProvider::getOrderStatusColor($item->order->order_status);
                                        @endphp
                                        <td>
                                            <a href="#"><span class="badge {{ $statusColor }}">{{ $item->order->order_status }}</span></a>
                                        </td>

                                    </tr>
                                @empty
                                @endforelse

                                <tr>
                                    <td>ORD20231214122</td>
                                    <td>14-12-2023</td>
                                    <td>Stiker Vinyl Outdoor</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>ORD20231214122</td>
                                    <td>14-12-2023</td>
                                    <td>Stiker Vinyl Outdoor</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>ORD20231214122</td>
                                    <td>14-12-2023</td>
                                    <td>Stiker Vinyl Outdoor</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>ORD20231214122</td>
                                    <td>14-12-2023</td>
                                    <td>Stiker Vinyl Outdoor</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td>ORD20231214122</td>
                                    <td>14-12-2023</td>
                                    <td>Stiker Vinyl Outdoor</td>
                                    <td>Mrs. Adela Beahan</td>
                                    <td><span class="badge bg-secondary">PENDING</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Konsumen</h5>
                        </div>
                        <div class="card-body d-flex w-100">
                            {{-- <div class="align-self-center chart chart-lg">
                                <canvas id="chartjs-dashboard-bar"></canvas>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
