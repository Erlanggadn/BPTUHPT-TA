    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Pengelolaan - PPID</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('ppid') }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('ppid.list.pembeli') }}">
                    <i class="bi bi-cart-fill"></i>
                    <span>Data Akun Pembeli</span>
                </a>
            </li>
            <li class="nav-heading">Siap Jual</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('ppid.sapi') }}">
                    <i class="bi bi-list-task"></i>
                    <span>List Sapi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('ppid.rumput') }}">
                    <i class="bi bi-list-task"></i>
                    <span>List Rumput</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-heading">JENIS PAKAN</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/wastukan/jenis_rumput">
                    <i class="bi bi-card-list"></i>
                    <span>Daftar Jenis Rumput</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/wastukan/tambah/jenis">
                    <i class="bi bi-journal-plus"></i>
                    <span>Tambah Jenis Rumput</span>
                </a>
            </li>
            <li class="nav-heading">PAKAN/RUMPUT SIAP JUAL</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/wastukan/rumput-siap-jual">
                    <i class="bi bi-card-list"></i>
                    <span>Daftar Rumput Siap Jual</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/rumput-siap-jual/create">
                    <i class="bi bi-journal-plus"></i>
                    <span>Tambah Rumput Siap Jual</span>
                </a>
            </li><!-- End Register Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
