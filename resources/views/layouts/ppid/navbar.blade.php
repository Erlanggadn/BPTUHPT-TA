<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src={{ asset('img/peternakan.png') }} alt="">
            <img src={{ asset('img/pkh.png') }} alt="">
            <img src={{ asset('img/bptu.png') }} alt="">

        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            {{-- <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon--> --}}
            <li class="nav-item dropdown pe-5">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img class="img-profile rounded-circle" src="{{ asset('img/profil.svg') }}">
                    <span style="text-transform: uppercase;"
                        class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}
                        ({{ Auth::user()->role}})</span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                    @auth
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('ppid.profil', Auth::user()->id) }}">
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
