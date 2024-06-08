@extends('layouts.utama.main')
@include('layouts.utama.header')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5">
            <div
                class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                <h2 data-aos="fade-up">selamat Datang 
                    @if(Auth::check() && Auth::user())
                    <b>{{ Auth::user()->name }} </b>
                    @else
                    @endif<br> , di BPTU HPT Padang
                    Mengatas<br></h2>
                <p data-aos="fade-up" data-aos-delay="100">Balai Pembibitan Ternak Unggul dan Hijauan Pakan Ternak
                    (BPTUHPT) Padang Mengatas merupakan salah satu unit pelaksana teknis (UPT) dibawah Direktorat
                    Jenderal Peternakan dan Kesehatan Hewan Kementerian Pertanian.</p>
                @if(Auth::check() && Auth::user())

                @else
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('pembeli.register') }}" class="btn-book-a-table">Daftar</a>
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
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                            <a href="#sapi" class="btn-book-a-table ">Lihat Selengkapnya <i
                                    class="bi bi-arrow-right-circle"></i></a>
                        </div>
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
                        <p>Dengan kandungan gizi yang optimal, konsistensi yang terjaga, dan formulasi yang disesuaikan,
                            pakan ternak kami memberikan nutrisi yang tepat untuk pertumbuhan dan kesehatan ternak Anda.
                        </p>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                            <a href="#rumput" class="btn-book-a-table ">Lihat Selengkapnya <i
                                    class="bi bi-arrow-right-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div><!-- End Chefs Member -->
        </div>
    </div>
</section><!-- End Chefs Section -->

<!-- ======= About Section ======= -->
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
        <div class="d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
                <p>
                    BPTUHPT Padang Mengatas adalah Unit Pelaksana Teknis (UPT) di bawah Direktorat Jenderal Peternakan
                    dan Kesehatan Hewan Kementerian Pertanian. Ini adalah satu-satunya UPT yang mengkhususkan diri dalam
                    produksi bibit sapi potong jenis Simental dan Limosin di Indonesia, sesuai dengan Peraturan Menteri
                    Pertanian Nomor 43 Tahun 2020 dan Peraturan Menteri Pertanian Nomor 36/Permentan/OT.140/8/2006
                    tentang Sistem Perbibitan Nasional. Moto BPTUHPT Padang Mengatas adalah "excellent breed is our
                    priority".
                </p>

                <p>
                    BPTUHPT Padang Mengatas berada pada ketinggian lokasi 790-1014 meter dari permukaan laut dengan suhu
                    udara antara 18 – 28 0C atau rata-rata 23 0C. Kelembapan sekitar 70%, curah hujan lebih kurang 1800
                    mm/tahun. Iklim tropis dan jenis tanah posolik merah kuning dengan tekstur liat dan pH tanah antara
                    5 – 6.5. <a href="">Baca Selengkapnya</a>.
                </p>
            </div>
        </div>
    </div>

    </div>
</section><!-- End About Section -->
<br>

{{-- Start tabel harga sapi --}}
<section id="sapi">
    <div class="section-header">
        <h2>Produk Kami</h2>
        <p><span>-Daftar</span>Harga<span>Sapi-</span></p>
    </div>
    <table class=" container table table-striped">
        <thead>
            <tr>
                <th scope="col">Jenis Sapi</th>
                <th scope="col">Jumlah Sapi Tersedia</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @isset($sapi)
            @foreach ($sapi as $item)
            <tr>
                <th>{{ $item->jenis}}</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
</section>
<br>
{{-- End Harga Sapi --}}
{{-- Start tabel harga rumput --}}
<section id="rumput">
    <div class="section-header">
        <h2>Produk Kami</h2>
        <p><span>-Daftar</span>Harga<span>Pakan</span>Ternak-</p>
    </div>
    <table class=" container table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</section>
{{-- End Harga Sapi --}}

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
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
            Designed by <a href="">Muhammad Erlangga Adi Nugraha</a>
        </div>
    </div>


</footer><!-- End Footer -->
