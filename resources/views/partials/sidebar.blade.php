<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <h5 style="font-family: 'Times New Roman'">MEUBEL LE'KOYO <li class="fas fa-home"></li></h5>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    <a href="/" class='sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (Auth()->user()->isAdmin == 1)
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Laporan</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('pengguna.laporan') }}">Pengguna</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('product.report') }}">Produk</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('cashier.report') }}">Transaksi</a>
                            </li>
                        </ul>
                    </li>
                @elseif (Auth()->user()->isAdmin == 2)
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('pengguna.index') }}">Data Pengguna</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('supplier.index') }}">Data Supplier</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('category.index') }}">Data Kategori</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('product.index') }}">Data Produk</a>
                            </li>
                        </ul>
                    </li>
                @elseif (Auth()->user()->isAdmin == 0)
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-collection-fill"></i>
                            <span>Transaksi</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('expenditures.index') }}">Pengeluaran</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('cashier.index') }}">Kasir</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('cashier.riwayat') }}">Riwayat Transaksi</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
