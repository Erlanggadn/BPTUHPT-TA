@include('layouts.utama.main2')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6  flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div><!-- End Logo -->
                        <form action="{{ route('formsapi') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">DATA TERNAK BARU LAHIR</h5>
                                        <p class="text-center small">Pastikan Data Diisi dengan Benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="row mb-3">
                                            <label class="col-form-label">Jenis Hewan Ternak</label>
                                            <div class="">
                                                <select name="jenis" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Pilih Jenis</option>
                                                    <option value="Simental">Simental</option>
                                                    <option value="Limosin">Limosin</option>
                                                    <option value="Pesisir">Pesisir</option>
                                                    <option value="Australia">Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourUsername" class="form-label">Urutan Lahir</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="urutan_lahir" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Masukkan Urutan Lahir dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourUsername" class="form-label">Tanggal Lahir</label>
                                            <div class="input-group has-validation">
                                                <input type="date" name="tanggal_lahir" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Masukkan Tanggal Lahir dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourUsername" class="form-label">No.ID Induk</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="no_induk" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Masukkan Data dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourUsername" class="form-label">Riwayat Penyakit <b>(jika tidak
                                                    ada, silahkan dikosongkan)</b></label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="riwayat_penyakit" class="form-control"
                                                    enctype="multipart/form-data" id="yourUsername">
                                                <div class="invalid-feedback">Masukkan Data dengan benar</div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit"><i
                                                    class="bi bi-box-arrow-in-right"></i> Daftarkan Identitas</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="/keswan" class="btn btn-outline-secondary w-100"><i
                                                    class="bi bi-house-door-fill"></i> Beranda</a>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
