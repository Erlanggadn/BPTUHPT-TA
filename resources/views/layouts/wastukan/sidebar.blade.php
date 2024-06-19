    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Pengelolaan - KESWAN</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('wastukan') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Dashboard Kegiatan Lahan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/wastukan/logbook">
                    <i class="bi bi-journal-plus"></i>
                    <span>Logbook Kegiatan</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-heading">Daftar Jenis</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.jenis.lahan') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Daftar Jenis Lahan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.jenis.rumput') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Daftar Jenis Rumput</span>
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
