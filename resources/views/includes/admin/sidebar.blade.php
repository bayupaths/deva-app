<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('dashboard-admin')}}">
            <img src="{{ url('/assets/images/deva.png') }}" alt="Logo" class="img-fluid w-10">
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Menu Utama
            </li>

            <li class="sidebar-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard-admin') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <a data-bs-target="#orders" data-bs-toggle="collapse" class="sidebar-link collapsed has-arrow">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Pemesanan</span>
                </a>
                <ul id="orders" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('admin.orders') }}"><i data-feather="arrow-right"></i> Daftar Pemesanan</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('processed.orders') }}"><i data-feather="arrow-right"></i> Pesanan Diproses</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('finished.orders') }}"><i data-feather="arrow-right"></i> Pesanan Selesai</a></li>
                </ul>
            </li>

            <li class="sidebar-item {{ request()->is('admin/transaction*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.transaction') }}">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Transaksi</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-profile.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Laporan</span>
                </a>
            </li>

            <li class="sidebar-header">
                Data
            </li>

            <li class="sidebar-item {{ request()->is('admin/category*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('category.index') }}">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Kategori
                        Produk</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/product*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('product.index') }}">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Produk</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/customer*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('customer.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Konsumen</span>
                </a>
            </li>


            <li class="sidebar-header">
                Pengaturan
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Akun Admin</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Sistem</span>
                </a>
            </li>


        </ul>
    </div>
</nav>
