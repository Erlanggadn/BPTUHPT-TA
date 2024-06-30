    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Wastukan - PROFIL</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('profilwastukan', Auth::user()->id) }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
            <li class="nav-heading">Wastukan - LAHAN</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.jenis.lahan') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Daftar Jenis Lahan</span>
                </a>
            </li>
            <li class="nav-heading">wastukan - rumput</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.jenis.rumput') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Daftar Jenis Rumput</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.rumput') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Daftar Rumput</span>
                </a>
            </li>
            <li class="nav-heading">Wastukan - Kegiatan Lahan</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.tanam') }}">
                    <i class="bi bi-list-nested"></i>
                    <span>Kegiatan Lahan</span>
                </a>
            </li>
            <li class="nav-heading">Wastukan - Pegawai</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('index.pegawai.wastukan') }}">
                    <i class="bi bi-file-person"></i>
                    <span>Daftar Pegawai</span>
                </a>
            </li>
            <li class="nav-heading">Wastukan - Logout</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </a>
            </li>


            <!-- End Register Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
