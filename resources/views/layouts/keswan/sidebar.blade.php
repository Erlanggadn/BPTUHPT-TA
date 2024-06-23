    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
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

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="/keswan/form">
                    <i class="bi bi-printer-fill"></i>
                    <span>Cetak Laporan</span>
                </a>
            </li><!-- End Register Page Nav --> --}}
        </ul>

    </aside><!-- End Sidebar-->
