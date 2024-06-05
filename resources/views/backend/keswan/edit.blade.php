@include('layouts.utama.main2')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6  flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div><!-- End Logo -->
                        <form action="{{ route('updatesapi', $sapi->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ubah Data</h5>
                                        <p class="text-center small">Pastikan Data Benar, hanya no induk dan Riwayat
                                            Penyakit yang dapat diubah
                                        </p>
                                    </div>
                                    <form class="row g-3 needs-validation" novalidate>
                                        <fieldset disabled>

                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">ID Sapi</label>
                                                <div class="input-group has-validation">
                                                    <span id="inputGroupPrepend"></span>
                                                    <input readonly type="text" value="{{ $sapi->id }}" name="id"
                                                        class="form-control" id="yourUsername" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Jenis Sapi</label>
                                                <div class="input-group has-validation">
                                                    <span id="inputGroupPrepend"></span>
                                                    <input readonly type="text" value="{{ $sapi->jenis }}" name="jenis"
                                                        class="form-control" id="yourUsername" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Urutan Lahir Sapi</label>
                                                <div class="input-group has-validation">
                                                    <span id="inputGroupPrepend"></span>
                                                    <input readonly type="text" value="{{ $sapi->urutan_lahir }}"
                                                        name="urutan_lahir" class="form-control" id="yourUsername"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Tanggal Lahir Sapi</label>
                                                <div class="input-group has-validation">
                                                    <span id="inputGroupPrepend"></span>
                                                    <input readonly type="date" value="{{ $sapi->tanggal_lahir }}"
                                                        name="tanggal_lahir" class="form-control" id="yourUsername"
                                                        required>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">No Induk Sapi</label>
                                            <div class="input-group has-validation">
                                                <span id="inputGroupPrepend"></span>
                                                <input type="text" value="{{ $sapi->no_induk }}" name="no_induk"
                                                    class="form-control" id="yourUsername" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Penyakit</label>
                                            <div class="input-group has-validation">
                                                <span id="inputGroupPrepend"></span>
                                                <input type="text" value="{{ $sapi->riwayat_penyakit }}"
                                                    name="riwayat_penyakit" class="form-control" id="yourUsername">
                                            </div>
                                        </div>

                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit"><i
                                                    class="bi bi-box-arrow-in-right"></i> Simpan</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('detailsapi', $sapi->id) }}"
                                                class="btn btn-outline-secondary w-100"><i
                                                    class="bi bi-house-door-fill"></i>
                                                Beranda</a>
                                        </div>
                                        <br>

                                    </form>
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
