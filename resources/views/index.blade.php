@extends('layouts.utama.main')
@include('layouts.utama.header')

<!-- ======= Hero Section ======= -->
<main>
    <section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div
                    class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                    <h2 data-aos="fade-up">selamat Datang
                        @if(Auth::check() && Auth::user())
                        <b style="color: #138220"><ins>{{ Auth::user()->pembeli->pembeli_nama}}</ins></b>
                        @else
                        @endif<br>di BPTU HPT Padang
                        Mengatas<br></h2>
                    <p data-aos="fade-up" data-aos-delay="100">Balai Pembibitan Ternak Unggul dan Hijauan Pakan Ternak
                        (BPTUHPT) Padang Mengatas merupakan salah satu unit pelaksana teknis (UPT) dibawah Direktorat
                        Jenderal Peternakan dan Kesehatan Hewan Kementerian Pertanian.</p>
                    @if(Auth::check() && Auth::user())

                    @else
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('daftar') }}" class="btn-book-a-table">Daftar Sekarang <i
                                class="bi bi-arrow-up-right-circle-fill"></i></a>
                    </div>
                    @endif
                </div>
                <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
                    <img src="{{ asset('img/wajah.png') }}" class="img-fluid" alt="" data-aos="zoom-out"
                        data-aos-delay="300">
                </div>
            </div>
        </div>
    </section><!-- End Hero Section -->

    <!-- ======= Chefs Section ======= -->
    <section id="beli" class="chefs section-bg">
        <div class="container py-4  " data-aos="fade-up">

            <div class="section-header">
                <p><span>-Layanan</span>Kami-</p>
            </div>

            <div class="row gy-4 mb-5" style="justify-content: center">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="chef-member">
                        <div class="member-img">
                            <img src="img/sapi.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Sapi</h4>
                            <span>Tersedia beragam jenis hewan ternak</span>
                            <p>Dengan kualitas daging yang tinggi, pertumbuhan yang cepat, serta ketahanan yang
                                handal.Jangan lewatkan kesempatan untuk memiliki sapi-sapi berkualitas ini.</p>
                            @if(Auth::check() && Auth::user()->role == 'pembeli')
                            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                <a href="#sapi" class="btn-book-a-table ">Lihat Selengkapnya <i
                                        class="bi bi-arrow-right-circle"></i></a>
                            </div>
                            @else
                            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                <a href="{{ route('daftar') }}" class="btn-book-a-table ">Lihat Selengkapnya <i
                                        class="bi bi-arrow-right-circle"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div><!-- End Chefs Member -->

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <div class="chef-member">
                        <div class="member-img">
                            <img src="img/rumput.jpeg" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Rumput</h4>
                            <span>Tersedia berbagai pakan ternak</span>
                            <p>Dengan kandungan gizi yang optimal, konsistensi yang terjaga, dan formulasi yang
                                disesuaikan,
                                pakan ternak kami memberikan nutrisi yang tepat untuk pertumbuhan dan kesehatan ternak
                                Anda.
                            </p>
                            @if(Auth::check() && Auth::user()->role == 'pembeli')
                            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                <a href="#sapi" class="btn-book-a-table ">Lihat Selengkapnya <i
                                        class="bi bi-arrow-right-circle"></i></a>
                            </div>
                            @else
                            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                <a href="{{ route('daftar') }}" class="btn-book-a-table ">Lihat Selengkapnya <i
                                        class="bi bi-arrow-right-circle"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div><!-- End Chefs Member -->
            </div>
        </div>
    </section><!-- End Chefs Section -->

    @if(Auth::check() && Auth::user()->role == 'pembeli')

    @else
    <section id="about" class="about">
        <div class="container mb-4" data-aos="fade-up">

            <div class="section-header">
                <h2>Tentang Kami</h2>
                <p>Baca Selengkapnya<span>Tentang Kami</span></p>
            </div>

            <div class="card mb-4 row gy-4">
                <div class="card-body">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/foto.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/foto2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/foto1.JPG" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                {{-- <div class="col-lg-7 position-relative about-img" style="background-image: url(img/foto.jpg);" data-aos="fade-up" data-aos-delay="150"> --}}

            </div>
            <div class="d-flex align-items-end " data-aos="fade-up" data-aos-delay="300">
                <div class="content ps-0 ps-lg-5">
                    <p>
                        BPTUHPT Padang Mengatas adalah Unit Pelaksana Teknis (UPT) di bawah Direktorat Jenderal
                        Peternakan
                        dan Kesehatan Hewan Kementerian Pertanian. Ini adalah satu-satunya UPT yang mengkhususkan diri
                        dalam
                        produksi bibit sapi potong jenis Simental dan Limosin di Indonesia, sesuai dengan Peraturan
                        Menteri
                        Pertanian Nomor 43 Tahun 2020 dan Peraturan Menteri Pertanian Nomor 36/Permentan/OT.140/8/2006
                        tentang Sistem Perbibitan Nasional. Moto BPTUHPT Padang Mengatas adalah "excellent breed is our
                        priority".
                    </p>

                    <p class="mb-4">
                        BPTUHPT Padang Mengatas berada pada ketinggian lokasi 790-1014 meter dari permukaan laut dengan
                        suhu
                        udara antara 18 – 28 0C atau rata-rata 23 0C. Kelembapan sekitar 70%, curah hujan lebih kurang
                        1800
                        mm/tahun. Iklim tropis dan jenis tanah posolik merah kuning dengan tekstur liat dan pH tanah
                        antara
                        5 – 6.5.
                    </p>
                </div>
            </div>
        </div>

        </div>
    </section><!-- End About Section -->
    <section id="maps" class="maps">
        <div class="container mb-4" data-aos="fade-up">
            <div class="section-header">
                <h2>Lokasi kami</h2>
                <p>Kunjungi Kami<span> disini</span></p>
            </div>
            <div class="text-center">
                <iframe style="width: 80%"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7700415037957!2d100.6851777736301!3d-0.2818641997153618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2ab54a02a257f5%3A0x1b37017a18f596e9!2sBPTU-HPT%20Padang%20Mengatas!5e0!3m2!1sid!2sid!4v1717929841048!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>


        </div>
    </section><!-- End About Section -->
    <br>
    @endif
    <!-- ======= About Section ======= -->

    @if(Auth::check() && Auth::user()->role == 'pembeli')
    {{-- Start tabel harga sapi --}}
    <section id="sapi" class="menu">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Menu</h2>
                <p>Check Harga <span>Sapi</span></p>
                <a href="{{ route('show.pengajuan.sapi') }}" class="btn btn-success"><i
                        class="bi bi-envelope-paper-fill"></i> Ajukan Pembelian
                    Sapi</a>
            </div>


            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
                        <h4>Simental</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
                        <h4>Limosin</h4>
                    </a><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
                        <h4>Pesisir</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
                        <h4>Australia</h4>
                    </a>
                </li><!-- End tab nav item -->

            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

                <div class="tab-pane fade active show" id="menu-starters">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Simental</h3>
                    </div>

                    <div class="container">
                        <div class="row gy-5 justify-content-center">
                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/simental.png') }}" class="glightbox"><img
                                        src="{{ asset('img/simental.png') }}" class="menu-img img-fluid" alt=""></a>
                                <h4>Jantan</h4>
                                <p class="ingredients">
                                    Tersedia
                                </p>
                                <p class="price">
                                    $5.95
                                </p>
                            </div><!-- Menu Item -->

                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/simental.png') }}" class="glightbox"><img
                                        src="{{ asset('img/simental.png') }}" class="menu-img img-fluid" alt=""></a>
                                <h4>Betina</h4>
                                <p class="ingredients">
                                    Tersedia
                                </p>
                                <p class="price">
                                    $14.95
                                </p>
                            </div><!-- Menu Item -->
                        </div>

                    </div>

                </div><!-- End Starter Menu Content -->

                <div class="tab-pane fade" id="menu-breakfast">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Limosin</h3>
                    </div>

                    <div class="container">
                        <div class="row gy-5 justify-content-center">
                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/limosin.png') }}" class="glightbox"><img
                                        src="{{ asset('img/limosin.png') }}" class="menu-img img-fluid" alt=""></a>
                                <h4>Jantan</h4>
                                <p class="ingredients">
                                    Lorem, deren, trataro, filede, nerada
                                </p>
                                <p class="price">
                                    $5.95
                                </p>
                            </div><!-- Menu Item -->

                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/limosin.png') }}" class="glightbox"><img
                                        src="{{ asset('img/limosin.png') }}" class="menu-img img-fluid" alt=""></a>
                                <h4>Betina</h4>
                                <p class="ingredients">
                                    Lorem, deren, trataro, filede, nerada
                                </p>
                                <p class="price">
                                    $14.95
                                </p>
                            </div><!-- Menu Item -->
                        </div>
                    </div>
                </div><!-- End Breakfast Menu Content -->

                <div class="tab-pane fade" id="menu-lunch">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Lunch</h3>
                    </div>

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Magnam Tiste</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $5.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-2.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Aut Luia</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $14.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-3.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Est Eligendi</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $8.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-4.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-5.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-6.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Laboriosam Direva</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $9.95
                            </p>
                        </div><!-- Menu Item -->

                    </div>
                </div><!-- End Lunch Menu Content -->

                <div class="tab-pane fade" id="menu-dinner">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Dinner</h3>
                    </div>

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Magnam Tiste</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $5.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-2.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Aut Luia</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $14.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-3.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Est Eligendi</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $8.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-4.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-5.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-6.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Laboriosam Direva</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $9.95
                            </p>
                        </div><!-- Menu Item -->

                    </div>
                </div><!-- End Dinner Menu Content -->

            </div>

        </div>
    </section><!-- End Menu Section -->
    <br>
    {{-- End Harga Sapi --}}
    {{-- Start tabel harga rumput --}}
    <section id="rumput" class="menu">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Menu</h2>
                <p>Check Harga <span>Rumput</span></p>
                <a href="" class="btn btn-success"><i class="bi bi-envelope-paper-fill"></i> Ajukan Pembelian
                    Rumput</a>
            </div>


            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
                        <h4>Starters</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
                        <h4>Breakfast</h4>
                    </a><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
                        <h4>Lunch</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
                        <h4>Dinner</h4>
                    </a>
                </li><!-- End tab nav item -->

            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

                <div class="tab-pane fade active show" id="menu-starters">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Starters</h3>
                    </div>

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Magnam Tiste</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $5.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-2.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Aut Luia</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $14.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-3.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Est Eligendi</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $8.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-4.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-5.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-6.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Laboriosam Direva</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $9.95
                            </p>
                        </div><!-- Menu Item -->

                    </div>
                </div><!-- End Starter Menu Content -->

                <div class="tab-pane fade" id="menu-breakfast">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Breakfast</h3>
                    </div>

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Magnam Tiste</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $5.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-2.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Aut Luia</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $14.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-3.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Est Eligendi</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $8.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-4.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-5.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-6.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Laboriosam Direva</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $9.95
                            </p>
                        </div><!-- Menu Item -->

                    </div>
                </div><!-- End Breakfast Menu Content -->

                <div class="tab-pane fade" id="menu-lunch">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Lunch</h3>
                    </div>

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Magnam Tiste</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $5.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-2.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Aut Luia</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $14.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-3.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Est Eligendi</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $8.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-4.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-5.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-6.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Laboriosam Direva</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $9.95
                            </p>
                        </div><!-- Menu Item -->

                    </div>
                </div><!-- End Lunch Menu Content -->

                <div class="tab-pane fade" id="menu-dinner">

                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Dinner</h3>
                    </div>

                    <div class="row gy-5">

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Magnam Tiste</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $5.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-2.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Aut Luia</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $14.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-3.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Est Eligendi</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $8.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-4.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-5.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Eos Luibusdam</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $12.95
                            </p>
                        </div><!-- Menu Item -->

                        <div class="col-lg-4 menu-item">
                            <a href="assets/img/menu/menu-item-6.png" class="glightbox"><img
                                    src="assets/img/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                            <h4>Laboriosam Direva</h4>
                            <p class="ingredients">
                                Lorem, deren, trataro, filede, nerada
                            </p>
                            <p class="price">
                                $9.95
                            </p>
                        </div><!-- Menu Item -->

                    </div>
                </div><!-- End Dinner Menu Content -->

            </div>

        </div>
    </section>
    {{-- End Harga Sapi --}}
    @else
    @endif


    <!-- ======= Footer ======= -->
    <footer id="kontak" class="footer">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>Alamat</h4>
                        <p>
                            Jl. Raya Payakumbuh-Lintau, KM.9 Pekan Sabtu, Kec. Luak Kab. Lima Puluh Kota, Payakumbuh.
                            Sumatra Barat. PO BOX03. Kode Pos 26201
                        </p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Hubungi Kami</h4>
                        <p>
                            <strong>Telepon:</strong> 082169402404<br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Jam Operasional</h4>
                        <p>
                            <strong>Senin - Jumat: </strong>8AM - 4PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Ikuti Kami</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>BPTU HPT - Tugas Akhir</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="">Muhammad Erlangga Adi Nugraha</a>
            </div>
        </div>
    </footer><!-- End Footer -->
</main>
<script src="{{ asset ('js/main.js') }}"></script>
