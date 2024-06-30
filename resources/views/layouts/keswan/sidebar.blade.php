    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">keswan - PROFIL</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('profilkeswan', Auth::user()->id) }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
            <li class="nav-heading">Pengelolaan - KESWAN</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.sapi') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Dashboard Sapi</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('pegawai.keswan') }}">
                    <i class="bi bi-file-person"></i>
                    <span>List Pegawai</span>
                </a>
            </li>
            <li class="nav-heading">keswan - Logout</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="/keswan/form">
                    <i class="bi bi-printer-fill"></i>
                    <span>Cetak Laporan</span>
                </a>
            </li><!-- End Register Page Nav --> --}}
        </ul>

    </aside><!-- End Sidebar-->
