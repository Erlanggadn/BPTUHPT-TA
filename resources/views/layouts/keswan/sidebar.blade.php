    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Pengelolaan - KESWAN</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('keswan') }}">
                    <i class="bi bi-list-task"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('pegawai.keswan') }}">
                    <i class="bi bi-file-person"></i>
                    <span>Daftar Pegawai Keswan</span>
                </a>
            </li>
            <li class="nav-heading">Form Tambah - KESWAN</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('formcreate') }}">
                    <i class="bi bi-journal-plus"></i>
                    <span>Form Ternak Lahir</span>
                </a>
            </li>
            <li class="nav-heading">Jenis Sapi</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.jenis.sapi') }}">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Jenis Sapi</span>
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
