<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">kepala- PROFIL</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('detail.profil.kepala', Auth::user()->user_id) }}">
                <i class="bi bi-person-circle"></i>
                <span>Profil Saya</span>
            </a>
        </li>
        <li class="nav-heading">KEPALA - HOME</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard.kepala') }}">
                <i class="bi bi-list-nested"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-heading">KEPALA - Pengajuan Beli</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.kepala.psapi') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pengajuan Sapi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index.kepala.prumput') }}">
                <i class="bi bi-list-nested"></i>
                <span>Pengajuan Rumput</span>
            </a>
        </li>
        <li class="nav-heading">Kepala - Logout</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-left"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>