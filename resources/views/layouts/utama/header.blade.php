@include('layouts.utama.main')


<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="" class="navbar-brand p-0">
            <img src="img/peternakan.png" alt="Logo" class="logo" width="5%">
            <img src="img/pkh.png" alt="Logo" class="logo" width="10%">
            <img src="img/bptu.png" alt="Logo" class="logo" width="20%">
        </a>
        <nav id="navbar" class="navbar">
            @if(Auth::check() && Auth::user()->role == 'pembeli')
            <ul>
                <li class="dropdown"><a href="#"><span>Layanan</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="#sapi"> Daftar Harga Sapi</a></li>
                        <li><a href="#rumput">Daftar Harga Rumput</a></li>
                    </ul>
                </li>
                <li><a href="#kontak">Kontak Kami</a></li>
                <li class="dropdown"><a href="#"><span>Profil</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="#sapi">Pesanan <i class="bi bi-cart-check-fill"></i></a></li>
                        <li><a href="#rumput">Profil Saya <i class="bi bi-person-fill-gear"></i></a></li>
                    </ul>
                </li>
            </ul>
            @else
            <ul>
                <li class="dropdown"><a href="#"><span>Layanan</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{ route('daftar') }}">Daftar Harga Sapi</a></li>
                        <li><a href="{{ route('daftar') }}">Daftar Harga Rumput</a></li>
                    </ul>
                </li>
                <li><a href="#maps">Lokasi</a></li>
                <li><a href="#kontak">Kontak Kami</a></li>
                <li><a href="#about">Tentang</a></li>
            </ul>
            @endif

        </nav><!-- .navbar -->

        @if(Auth::check() && Auth::user()->role == 'pembeli')
        <a class="btn-book-a-table" href="{{ route('logout') }}">Logout</a>
        @else
        <a class="btn-book-a-table" href="{{ route('loginpembeli') }}">Login</a>
        @endif

        {{-- <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i> --}}
    </div>
</header><!-- End Header -->
<script src="{{ asset ('js/main.js') }}"></script>
