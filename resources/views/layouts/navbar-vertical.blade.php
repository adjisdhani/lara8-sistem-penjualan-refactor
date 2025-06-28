<!-- Sidebar -->
<nav class="navbar-vertical navbar">
    <div class="nav">
        <!-- Brand logo -->
        <a class="navbar-brand" href="#">
            <div class="h3 text-center">Aplikasi Data <br>Penjualan</div>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow {{ ($active === "dashboard") ? 'active' : '' }}" href="{{ url('/') }}">
                    <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($active === "jenis_penjualan") ? 'active' : '' }}"
                    href="{{ route('jenis-penjualan.index') }}">
                    <i data-feather="database" class="nav-icon icon-xs me-2">
                    </i>
                    Data Jenis Barang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($active === "barang_penjualan") ? 'active' : '' }}"
                    href="{{ route('barang-penjualan.index') }}">
                    <i data-feather="database" class="nav-icon icon-xs me-2">
                    </i>
                    Data Barang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($active === "master_penjualan") ? 'active' : '' }}"
                    href="{{ route('master-penjualan.index') }}">
                    <i data-feather="database" class="nav-icon icon-xs me-2">
                    </i>
                    Data Master Penjualan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($active === "transaksi_penjualan") ? 'active' : '' }}"
                    href="{{ route('transaksi-penjualan.index') }}">
                    <i data-feather="database" class="nav-icon icon-xs me-2">
                    </i>
                    Data Log Transaksi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($active === "setting_user") ? 'active' : '' }}"
                    href="{{ route('setting-user.index') }}">
                    <i data-feather="database" class="nav-icon icon-xs me-2">
                    </i>
                    Setting User
                </a>
            </li>

            <li class="nav-item" style="display: none">
                <a class="nav-link {{ ($active === "perbandingan_penjualan") ? 'active' : '' }}"
                    href="{{ route('perbandingan-penjualan.index') }}">
                    <i data-feather="database" class="nav-icon icon-xs me-2">
                    </i>
                    Perbandingan Jenis Data
                </a>
            </li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start">
                        <i data-feather="log-out" class="nav-icon icon-xs me-2"></i>
                        Logout
                    </button>
                </form>
            </li>


        </ul>
    </div>
</nav>
