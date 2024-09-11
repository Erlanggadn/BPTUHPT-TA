<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Admin - PROFIL</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profiladmin', Auth::user()->user_id) }}">
                <i class="bi bi-person-circle"></i>
                <span>Profil Saya</span>
            </a>
        </li>
        <li class="nav-heading">Admin - Kelola Akun</li>
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
        <li class="nav-heading">Admin - Tambah Akun</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('pegawaidaftar') }}">
                <i class="bi bi-person-add"></i>
                <span>Form Akun</span>
            </a>
        </li>
        <li class="nav-heading">Admin - Logout</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-left"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->