    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Kelola akun - Admin</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard.admin') }}">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Dashboard Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('akunadmin') }}">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Data Pegawai</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('akunpembeli') }}">
                    <i class="bi bi-cart-check-fill"></i>
                    <span>Data Pembeli</span>
                </a>
            </li>
            <li class="nav-heading">Tambah Akun - Admin</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('pegawaidaftar') }}">
                    <i class="bi bi-person-add"></i>
                    <span>Form Akun</span>
                </a>
            </li>
            {{-- <li class="nav-heading">Laporan - Admin</li> --}}

            <!-- End Register Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
