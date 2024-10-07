<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">bendahara- PROFIL</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profilbendahara', Auth::user()->user_id) }}">
                <i class="bi bi-person-circle"></i>
                <span>Profil Saya</span>
            </a>
        </li>
        <li class="nav-heading">Bendahara - Pembelian Produk</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.bendahara.psapi') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pembelian Sapi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.bendahara.prumput') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pembelian Rumput</span>
            </a>
        </li>
        <li class="nav-heading">Bendahara - Logout</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-left"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>