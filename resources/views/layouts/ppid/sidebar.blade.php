<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">ppid- PROFIL</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('detail.profil.ppid', Auth::user()->user_id) }}">
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
        <li class="nav-heading">PPID - Harga Produk</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.harga.sapi') }}">
                <i class="bi bi-currency-dollar"></i>
                <span>Sapi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.harga.rumput') }}">
                <i class="bi bi-currency-dollar"></i>
                <span>Rumput</span>
            </a>
        </li>
        <li class="nav-heading">PPID - Sapi</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.ppid.sapi') }}">
                <i class="bi bi-list-nested"></i>
                <span>Sapi Siap Jual</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.ppid.psapi') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pengajuan Sapi</span>
            </a>
        </li>
        <li class="nav-heading">PPID - Rumput</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.ppid.rumput') }}">
                <i class="bi bi-list-nested"></i>
                <span>Rumput Siap Jual</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.ppid.prumput') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pengajuan Rumput</span>
            </a>
        </li>



        {{-- <li class="nav-heading">PPID - Pembelian</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.ppid.psapi') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pembelian Sapi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.ppid.prumput') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pembelian Rumput</span>
            </a>
        </li> --}}
        <li class="nav-heading">PPID - Logout</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-left"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>