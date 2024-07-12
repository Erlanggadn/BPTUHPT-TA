    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Pembeli - Home</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('home') }}">
                    <i class="bi bi-shop"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-heading">Pembeli - List Pengajuan</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.pengajuan.sapi') }}">
                    <i class="bi bi-cart-check"></i>
                    <span>Sapi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.pengajuan.rumput') }}">
                    <i class="bi bi-cart-check"></i>
                    <span>Rumput</span>
                </a>
            </li>
            <li class="nav-heading">Pembeli - Form Pengajuan</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('show.pengajuan.sapi') }}">
                    <i class="bi bi-plus"></i>
                    <span>Sapi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('show.pengajuan.rumput') }}">
                    <i class="bi bi-plus"></i>
                    <span>Rumput</span>
                </a>
            </li>
            <li class="nav-heading">Pembeli - Logout</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>
