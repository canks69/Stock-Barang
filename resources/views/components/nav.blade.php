<div class="nav-content d-flex">
    <!-- Logo Start -->
    <div class="logo position-relative">
        <a href="{{ route('dashboards') }}">
            <!-- Logo can be added directly -->
            <!-- <img src="/img/logo/logo-white.svg" alt="logo" /> -->
            <!-- Or added via css to provide different ones for different color themes -->
            <div class="img"></div>
        </a>
    </div>
    <!-- Logo End -->

    <!-- User Menu Start -->
    <div class="user-container d-flex">
        <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="profile" alt="profile" src="/img/profile/profile-9.webp" />
            <div class="name">{{ Auth::user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-end user-menu wide">
            <div class="row mb-3 ms-0 me-0">
                <div class="col-12 ps-1 mb-2">
                    <div class="text-extra-small text-primary">ACCOUNT</div>
                </div>
                <div class="col-12 ps-1 pe-1">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#">User Info</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- User Menu End -->

    <!-- Icons Menu Start -->
    <ul class="list-unstyled list-inline text-center menu-icons">
        <li class="list-inline-item">
            <a href="#" id="pinButton" class="pin-button">
                <i data-acorn-icon="lock-on" class="unpin" data-acorn-size="18"></i>
                <i data-acorn-icon="lock-off" class="pin" data-acorn-size="18"></i>
            </a>
        </li>
        <li class="list-inline-item">
            <a href="#" id="colorButton">
                <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
                <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
            </a>
        </li>
        <li class="list-inline-item">
            <a href="{{ route('logout') }}" class="pin-button" 
                onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();">
                <i data-acorn-icon="logout" data-acorn-size="18"></i>
            </a>
        </li>
    </ul>
    <!-- Icons Menu End -->

    <!-- Menu Start -->
    <div class="menu-container flex-grow-1">
        <ul id="menu" class="menu">
            <li>
                <a href="{{ route('dashboards') }}" data-href="/dashboards">
                    <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                    <span class="label">Dashboards</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.index') }}" data-href="/customer">
                    <i data-acorn-icon="building-large" class="icon" data-acorn-size="18"></i>
                    <span class="label">Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="#Transaksi" data-href="/Transaksi">
                    <i data-acorn-icon="web-page" class="icon" data-acorn-size="18"></i>
                    <span class="label">Transaksi</span>
                </a>
                <ul id="Transaksi">
                    <li>
                        <a href="{{ route('sales.index') }}" data-href="/sales">
                            <span class="label">Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('purchase.index') }}" data-href="/purchase">
                            <span class="label">Pembelian</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#ManajemenStock" data-href="/ManajemenStock">
                    <i data-acorn-icon="laptop" class="icon" data-acorn-size="18"></i>
                    <span class="label">Manajemen Stock</span>
                </a>
                <ul id="ManajemenStock">
                    <li>
                        <a href="{{ route('stock.index') }}" data-href="/stock">
                            <span class="label">Stock</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}" data-href="/category">
                            <span class="label">Kategori</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#Laporan" data-href="/Laporan">
                    <i data-acorn-icon="file-text" class="icon" data-acorn-size="18"></i>
                    <span class="label">Laporan</span>
                </a>
                <ul id="Laporan">
                    {{-- <li>
                        <a href="{{ route('report.stock.index') }}" data-href="/report/stock">
                            <span class="label">Laporan Stock</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('report.sales.index') }}" data-href="/report/sales">
                            <span class="label">Laporan Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.purchase.index') }}" data-href="/report/purchase">
                            <span class="label">Laporan Pembelian</span>
                        </a>
                    </li>
                </ul>
            </li>
            @if(Auth::user()->role == 'admin')
            <li>
                <a href="#Pengaturan" data-href="/Pengaturan">
                    <i data-acorn-icon="gear" class="icon" data-acorn-size="18"></i>
                    <span class="label">Pengaturan</span>
                </a>
                <ul id="Pengaturan">
                    <li>
                        <a href="{{ route('user.index') }}" data-href="/user">
                            <span class="label">Pengguna</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
    <!-- Menu End -->

    <!-- Mobile Buttons Start -->
    <div class="mobile-buttons-container">
        <!-- Scrollspy Mobile Button Start -->
        <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
            <i data-acorn-icon="menu-dropdown"></i>
        </a>
        <!-- Scrollspy Mobile Button End -->

        <!-- Scrollspy Mobile Dropdown Start -->
        <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
        <!-- Scrollspy Mobile Dropdown End -->

        <!-- Menu Button Start -->
        <a href="#" id="mobileMenuButton" class="menu-button">
            <i data-acorn-icon="menu"></i>
        </a>
        <!-- Menu Button End -->
    </div>
    <!-- Mobile Buttons End -->
</div>
<div class="nav-shadow"></div>
