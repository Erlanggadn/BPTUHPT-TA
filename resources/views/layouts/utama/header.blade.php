<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="" class="navbar-brand p-0">
            <img src="img/peternakan.png" alt="Logo" class="logo" width="5%">
            <img src="img/pkh.png" alt="Logo" class="logo" width="10%">
            <img src="img/bptu.png" alt="Logo" class="logo" width="20%">
        </a>

        <nav id="navbar" class="navbar">
            <ul>

                <li class="dropdown"><a href="#"><span>Layanan</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="#sapi">Daftar Harga Sapi</a></li>
                        <li><a href="#rumput">Daftar Harga Rumput</a></li>
                    </ul>
                </li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="#about">Tentang</a></li>
            </ul>
        </nav><!-- .navbar -->

        @if(Auth::check() && Auth::user()->role == 'pembeli')
        <a class="btn-book-a-table" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else
        <a class="btn-book-a-table" href="{{ route('login') }}">Masuk</a>
        @endif
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header><!-- End Header -->
