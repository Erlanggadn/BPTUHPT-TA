@include('layouts.utama.main2')
@include('layouts.kepala.navbar')
@include('layouts.kepala.sidebar')

<main id="main" class="main">
    <div class="pagetitle mb-4">
        <h1>Dashboard Kepala Balai</h1>
    </div>

    <div class="pagetitle">
        <h5>Penjualan BPTU HPT</h5>
    </div>
    <section class="section dashboard">
        <div class="row">
            <!-- Jumlah Pengajuan Sapi -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Pengajuan Sapi <span>| BPTU HPT</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $jumlahPengajuanSapi }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan card untuk data lain -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Pengajuan Rumput <span>| BPTU HPT</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan lebih banyak card sesuai kebutuhan -->

        </div>
    </section>
</main>