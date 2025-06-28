<!-- Sidebar -->
<nav class="navbar-vertical navbar">
    <div class="nav">
        <!-- Brand logo -->
        <a class="navbar-brand" href="#">
            <div class="h3 text-center">Aplikasi Data <br>Penjualan</div>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            @foreach ($menus as $menu)
                @if (in_array(auth()->user()->role, $menu->roles))
                    <li class="nav-item">
                        @if ($menu->key === "logout")
                            <form action="{{ $menu->route }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-start">
                                    <i data-feather="{{ $menu->icon }}" class="nav-icon icon-xs me-2"></i>
                                    {{ $menu->label }}
                                </button>
                            </form>
                        @else
                            <a class="nav-link {{ ($active === $menu->key) ? 'active' : '' }}"
                                href="{{ $menu->route }}">
                                <i data-feather="{{ $menu->icon }}" class="nav-icon icon-xs me-2"></i>
                                {{ $menu->label }}
                            </a>
                        @endif
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</nav>