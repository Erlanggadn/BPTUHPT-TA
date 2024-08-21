@extends('layouts.utama.main')
@include('layouts.utama.header')

<main>
    {{-- DASHBOARD INFO --}}
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
    </section>
    {{-- END DASHBORAD --}}

    {{-- HALAMAN MENU --}}
    <section id="beli" class="chefs section-bg">
        <div class="container py-4  " data-aos="fade-up">
            {{-- VIDEO PROFILE --}}
            @if(Auth::check() && Auth::user())
            @else
            <div>
                <div class="section-header">
                    <h2>Video Kami</h2>
                    <p>Cerita Kami<span> disini</span></p>
                </div>
                <div class="text-center mb-4">
                    <iframe width="679" height="382" src="https://www.youtube.com/embed/WdxHTJk7_Rg?"
                        title="BPTU-HPT Padang Mengatas Ramah Untuk Semua" frameborder="0"
                        allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            @endif
            {{-- END VIDEO PROFILE --}}
            {{-- LAYANAN KAMI --}}
            <div>
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
                                <div class="d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                                    <a href="{{ route('show.pengajuan.sapi') }}" class="btn-book-a-table ">Ajukan
                                        Pembelian
                                        <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                    <a href="{{ route('cetak.template.sapi') }}" class="btn-book-a-table ">Cetak
                                        Template Surat
                                        <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                                @else
                                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                    <a href="{{ route('daftar') }}" class="btn-book-a-table ">Lihat Selengkapnya <i
                                            class="bi bi-arrow-right-circle"></i></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
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
                                    pakan ternak kami memberikan nutrisi yang tepat untuk pertumbuhan dan kesehatan
                                    ternak
                                    Anda.
                                </p>
                                @if(Auth::check() && Auth::user()->role == 'pembeli')
                                <div class="d-flex mb-4" data-aos="fade-up" data-aos-delay="200">
                                    <a href="{{ route('show.pengajuan.rumput') }}" class="btn-book-a-table ">Ajukan
                                        Pembelian <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                    <a href="{{ route('cetak.template.rumput') }}" class="btn-book-a-table ">Cetak
                                        Template Surat
                                        <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                                @else
                                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                    <a href="{{ route('daftar') }}" class="btn-book-a-table ">Lihat Selengkapnya <i
                                            class="bi bi-arrow-right-circle"></i></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END LAYANAN KAMI --}}
        </div>
    </section>
    {{-- END HALAMAN MENU --}}

    {{-- TENTANG KAMI --}}
    <div>
        @if(Auth::check() && Auth::user()->role == 'pembeli')
        @else
        <section id="about" class="about">
            <div class="container mb-4" data-aos="fade-up">
                <div class="section-header">
                    <h2>Tentang Kami</h2>
                    <p>Baca Selengkapnya<span>Tentang Kami</span></p>
                </div>
                <div class="card mb-4 shadow row gy-4">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('img/profiltiga.jpg') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('img/profilsatu.jpeg') }}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('img/profildua.jpg') }}" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-body">
                                <p>
                                    BPTUHPT Padang Mengatas adalah Unit Pelaksana Teknis (UPT) di bawah Direktorat
                                    Jenderal Peternakan
                                    dan Kesehatan Hewan Kementerian Pertanian. Ini adalah satu-satunya UPT yang
                                    mengkhususkan diri
                                    dalam produksi bibit sapi potong jenis Simental dan Limosin di Indonesia, sesuai
                                    dengan Peraturan
                                    Menteri Pertanian Nomor 43 Tahun 2020 dan Peraturan Menteri Pertanian Nomor
                                    36/Permentan/OT.140/8/2006 tentang Sistem Perbibitan Nasional. Moto BPTUHPT Padang
                                    Mengatas adalah
                                    "excellent breed is our priority".
                                </p>
                                <p class="mb-4">
                                    BPTUHPT Padang Mengatas berada pada ketinggian lokasi 790-1014 meter dari permukaan
                                    laut dengan
                                    suhu udara antara 18 – 28 0C atau rata-rata 23 0C. Kelembapan sekitar 70%, curah
                                    hujan lebih
                                    kurang 1800 mm/tahun. Iklim tropis dan jenis tanah posolik merah kuning dengan
                                    tekstur liat dan pH tanah
                                    antara 5 – 6.5.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    {{-- END TENTANG KAMI --}}

    {{-- LOKASI KAMI --}}
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
    </section>
    {{-- END TENTANG KAMI --}}
    <br>

    @endif
    @if(Auth::check() && Auth::user()->role == 'pembeli')
    {{-- HARGA SAPI --}}
    <section id="sapi" class="menu">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Menu</h2>
                <p>Check Harga <span>Sapi</span></p>
            </div>
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
                        <h4>Simental</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
                        <h4>Limosin</h4>
                    </a>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
                        <h4>Pesisir</h4>
                    </a>
                </li>
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
                                <a href="{{ asset('img/simental.png') }}" class="glightbox">
                                    <img src="{{ asset('img/simental.png') }}" class="menu-img img-fluid"
                                        alt="Simental">
                                </a>
                                <h4 class="mt-3">Jantan</h4>
                                <p class="ingredients text-muted">Tersedia</p>
                                <div class="price-list mt-3">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="table-success">
                                                <th>Umur</th>
                                                <th class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bibit Umur 6 - 9 Bulan</td>
                                                <td class="text-end">Rp.12.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 9 - 12 Bulan</td>
                                                <td class="text-end">Rp.14.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 12 - 15 Bulan</td>
                                                <td class="text-end">Rp.16.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 15 - 18 Bulan</td>
                                                <td class="text-end">Rp.18.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 18 - < 24 Bulan</td> <td class="text-end">
                                                        Rp.20.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 24 - <36 Bulan</td> <td class="text-end">
                                                        Rp.25.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 36 Bulan</td>
                                                <td class="text-end">Rp.28.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Calon Bull (Pejantan) Umur 18 - 24 Bulan</td>
                                                <td class="text-end">Rp.30.000.000/Ekor</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/simental.png') }}" class="glightbox">
                                    <img src="{{ asset('img/simental.png') }}" class="menu-img img-fluid"
                                        alt="Simental">
                                </a>
                                <h4 class="mt-3">Betina</h4>
                                <p class="ingredients text-muted">Tersedia</p>
                                <div class="price-list mt-3">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="table-success">
                                                <th>Umur</th>
                                                <th class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Umur 6 - 9 Bulan</td>
                                                <td class="text-end">Rp.11.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 9 - 12 Bulan</td>
                                                <td class="text-end">Rp.13.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 12 - 15 Bulan</td>
                                                <td class="text-end">Rp.15.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 15 - 18 Bulan</td>
                                                <td class="text-end">Rp.17.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 18 - < 24 Bulan</td> <td class="text-end">Rp.19.000.000/Ekor
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 24 - < 36 Bulan</td> <td class="text-end">Rp.23.000.000/Ekor
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    Tersedia
                                </p>
                                <div class="price-list mt-3">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="table-success">
                                                <th>Umur</th>
                                                <th class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bibit Umur 6 - 9 Bulan</td>
                                                <td class="text-end">Rp.12.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 9 - 12 Bulan</td>
                                                <td class="text-end">Rp.14.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 12 - 15 Bulan</td>
                                                <td class="text-end">Rp.16.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 15 - 18 Bulan</td>
                                                <td class="text-end">Rp.18.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 18 - < 24 Bulan</td> <td class="text-end">
                                                        Rp.20.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 24 - <36 Bulan</td> <td class="text-end">
                                                        Rp.25.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Bibit Umur > 36 Bulan</td>
                                                <td class="text-end">Rp.28.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Calon Bull (Pejantan) Umur 18 - 24 Bulan</td>
                                                <td class="text-end">Rp.30.000.000/Ekor</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/limosin.png') }}" class="glightbox"><img
                                        src="{{ asset('img/limosin.png') }}" class="menu-img img-fluid" alt=""></a>
                                <h4>Betina</h4>
                                <p class="ingredients">
                                    Tersedia
                                </p>
                                <div class="price-list mt-3">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="table-success">
                                                <th>Umur</th>
                                                <th class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Umur 6 - 9 Bulan</td>
                                                <td class="text-end">Rp.11.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 9 - 12 Bulan</td>
                                                <td class="text-end">Rp.13.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 12 - 15 Bulan</td>
                                                <td class="text-end">Rp.15.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 15 - 18 Bulan</td>
                                                <td class="text-end">Rp.17.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 18 - < 24 Bulan</td> <td class="text-end">Rp.19.000.000/Ekor
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 24 - < 36 Bulan</td> <td class="text-end">Rp.23.000.000/Ekor
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="menu-lunch">
                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Pesisir</h3>
                    </div>
                    <div class="container">
                        <div class="row gy-5 justify-content-center">
                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/pesisir.png') }}" class="glightbox"><img
                                        src="{{ asset('img/pesisir.png') }}" class="menu-img img-fluid" alt=""></a>
                                <h4>Jantan</h4>
                                <p class="ingredients">
                                    Tersedia
                                </p>
                                <div class="price-list mt-3">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="table-success">
                                                <th>Umur</th>
                                                <th class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Umur 6 - 9 Bulan</td>
                                                <td class="text-end">Rp.3.500.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 9 - 12 Bulan</td>
                                                <td class="text-end">Rp.4.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 12 - 15 Bulan</td>
                                                <td class="text-end">Rp.5.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 15 - 18 Bulan</td>
                                                <td class="text-end">Rp.7.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 18 - < 24 Bulan</td> <td class="text-end">Rp.10.000.000/Ekor
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 24 - < 36 Bulan</td> <td class="text-end">Rp.12.000.000/Ekor
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Umur ≥ 36 Bulan</td>
                                                <td class="text-end">Rp.14.000.000/Ekor</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('img/pesisir.png') }}" class="glightbox"><img
                                        src="{{ asset('img/pesisir.png') }}" class="menu-img img-fluid" alt=""></a>
                                <h4>Betina</h4>
                                <p class="ingredients">
                                    Tersedia
                                </p>
                                <div class="price-list mt-3">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="table-success">
                                                <th>Umur</th>
                                                <th class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Umur 6 - 9 Bulan</td>
                                                <td class="text-end">Rp.3.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 9 - 12 Bulan</td>
                                                <td class="text-end">Rp.3.500.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 12 - 15 Bulan</td>
                                                <td class="text-end">Rp.55.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 15 - 18 Bulan</td>
                                                <td class="text-end">Rp.6.000.000/Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 18 - < 24 Bulan</td> <td class="text-end">Rp.8.000.000/Ekor
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Umur > 24 - < 36 Bulan</td> <td class="text-end">Rp.10.000.000/Ekor
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    {{-- END HARGA SAPI --}}

    {{-- HARGA RUMPUT --}}
    <section id="rumput" class="menu">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Menu</h2>
                <p>Check Harga <span>Rumput</span></p>
            </div>
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-benih">
                        <h4>Benih dan HPT</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-hasil">
                        <h4>Hasil Ikutan</h4>
                    </a>
                </li>
            </ul>
            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                <div class="tab-pane fade active show mb-4" id="menu-benih">
                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Benih dan HPT</h3>
                    </div>
                    <div class="row gy-5">
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Rumput Padang Pengembalaan</h4>
                                    <p class="card-text">Per Pools</p>
                                    <p class="card-text price">Rp. 200</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Rumput Potong</h4>
                                    <p class="card-text">Per Stek</p>
                                    <p class="card-text price">Rp. 200</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Rumput Potong</h4>
                                    <p class="card-text">Per Pools</p>
                                    <p class="card-text price">Rp. 500</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Rumput (Biji)</h4>
                                    <p class="card-text">Per Kilogram</p>
                                    <p class="card-text price">Rp. 200.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Leguminosa Pohon</h4>
                                    <p class="card-text">Tersedia</p>
                                    <p class="card-text price">Rp. 350 /Stek</p>
                                    <p class="card-text price">Rp. 5.00 /Batang</p>
                                    <p class="card-text price">Rp. 250.000 /Kilogram</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Leguminosa Menjalar</h4>
                                    <p class="card-text">Tersedia</p>
                                    <p class="card-text price">Rp. 100.000 /Kilogram</p>
                                    <p class="card-text price">Rp. 200 /Stolon</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade mb-4 " id="menu-hasil">
                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>Hasil Ikutan</h3>
                    </div>
                    <div class="row gy-5">
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Kompos</h4>
                                    <p class="card-text">Harga (Per Kilogram)</p>
                                    <p class="card-text price">Rp. 400</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Rumput Pakan Ternak</h4>
                                    <p class="card-text">Harga (Per Kilogram)</p>
                                    <p class="card-text price">Rp. 200</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Silase</h4>
                                    <p class="card-text">Harga (Per Kilogram)</p>
                                    <p class="card-text price">Rp. 500</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 menu-item">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title">Mineral Block</h4>
                                    <p class="card-text">Harga (Per Kilogram)</p>
                                    <p class="card-text price">Rp. 10.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- END HARGA RUMPUT --}}
    @else
    @endif

    {{-- KONTAK KAMI --}}
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
    </footer>
    {{-- END KONTAK KAMI --}}
</main>

<script src="{{ asset ('js/main.js') }}"></script>
<script src="{{ asset('vendor/aos/aos.js') }}"></script>
<script>
    AOS.init();

</script>
<script src="{{ asset('vendor/swiper/swiper-bundle.min.css') }}"></script>
