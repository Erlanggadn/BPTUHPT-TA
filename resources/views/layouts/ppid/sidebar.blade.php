    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">ppid- PROFIL</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
            <li class="nav-heading">PPID - Pembeli</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.daftar.pembeli') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Daftar Akun Pembeli</span>
                </a>
            </li>
            <li class="nav-heading">PPID - Sapi</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.ppid.sapi') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>List Sapi Jual</span>
                </a>
            </li>
            <li class="nav-heading">PPID - Rumput</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.ppid.rumput') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>List Rumput Jual</span>
                </a>
            </li>
            <li class="nav-heading">PPID - Pengajuan Beli</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.daftar.pembeli') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Daftar Pengajuan</span>
                </a>
            </li>
            <li class="nav-heading">Wastukan - Logout</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </aside>
