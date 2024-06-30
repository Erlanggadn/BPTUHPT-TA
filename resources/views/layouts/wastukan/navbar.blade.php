<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between w-100">
        <a href="" class="logo d-flex align-items-center">
            <img src="{{ asset('img/peternakan.png') }}" alt="">
            <img src="{{ asset('img/pkh.png') }}" alt="">
            <img src="{{ asset('img/bptu.png') }}" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center mb-0">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img class="img-profile rounded-circle" src="{{ asset('img/profil.svg') }}">
                </a><!-- End Profile Image Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                    @auth
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('profilwastukan', Auth::user()->id) }}">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span> <!-- Ganti 'name' dengan field yang sesuai -->
                        </a>
                    </li>
                    @endauth
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->
