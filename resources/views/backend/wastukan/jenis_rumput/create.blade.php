@include('layouts.utama.main')
@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div>
                        <form action="{{ route('store.jenis.rumput') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Jenis Rumput</h5>
                                        <p class="text-center small">Pastikan Data Benar!</p>
                                    </div>
                                    @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first() }}
                                    </div>
                                    @endif
                                    <form class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="rumNama" class="form-label">Nama Rumput</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="rum_nama" class="form-control" id="rumNama"
                                                    required>
                                                <div class="invalid-feedback">Masukkan Nama Rumput dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="rumKeterangan" class="form-label">Keterangan</label>
                                            <div class="input-group has-validation">
                                                <textarea type="text" name="rum_keterangan" class="form-control"
                                                    id="rumKeterangan" required></textarea>
                                                <div class="invalid-feedback">Masukkan Keterangan dengan benar</div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">Tambah</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.jenis.rumput') }}"
                                                class="btn btn-secondary w-100">Kembali</a>
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
</main>

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
