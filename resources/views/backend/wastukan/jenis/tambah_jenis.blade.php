@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"></div>
                        <form action="{{ route('postjenis') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Jenis Rumput</h5>
                                        <p class="text-center small">Masukkan Data Jenis Rumput dengan Benar!</p>
                                    </div>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="jenis_rumput" class="form-label"><b>Jenis Rumput</b></label>
                                            <input type="text" name="jenis_rumput" class="form-control"
                                                id="jenis_rumput" required>
                                            <div class="invalid-feedback">Masukkan jenis rumput dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="kode_rumput" class="form-label"><b>Kode Rumput</b> (Gunakan
                                                huruf Kapital)</label>
                                            <input type="text" name="kode_rumput" class="form-control" id="kode_rumput"
                                                required>
                                            <div class="invalid-feedback">Masukkan kode rumput dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="deskripsi_rumput" class="form-label"><b>Deskripsi Rumput</b>
                                                (Tambahkan keterangan rumput)</label>
                                            <input type="text" name="deskripsi_rumput" class="form-control"
                                                id="deskripsi_rumput">
                                            <div class="invalid-feedback">Masukkan deskripsi rumput dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit">Tambah</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ route('indexrumput') }}"
                                                class="btn btn-outline-secondary w-100">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/main.js"></script>
