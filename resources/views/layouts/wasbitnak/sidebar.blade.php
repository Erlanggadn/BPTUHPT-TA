    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Wasbitnak - PROFIL</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('profilwasbitnak', Auth::user()->id) }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
            <li class="nav-heading">Wasbitnak - Sapi</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.jenis.sapi') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Jenis Sapi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.sapi.wasbitnak') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Kondisi Sapi</span>
                </a>
            </li>
            <li class="nav-heading">wasbitnak - Kandang</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.jenis.kandang') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Jenis Kandang/Plot</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.kandang') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Kandang</span>
                </a>
            </li>
            <li class="nav-heading">Wasbitnak - Kegiatan Kandang</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.kegiatan.kandang') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Logbook Kegiatan</span>
                </a>
            </li>
            <li class="nav-heading">Wasbitnak - Pegawai</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.pegawai.wasbitnak') }}">
                    <i class="bi bi-file-person"></i>
                    <span>Daftar Pegawai</span>
                </a>
            </li>
            <li class="nav-heading">wasbitnak - Logout</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </a>
            </li>
            <!-- End Register Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
