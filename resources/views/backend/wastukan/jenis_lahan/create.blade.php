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
                        <form action="{{ route('store.jenis.lahan') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Jenis Lahan</h5>
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
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="lahanNama" class="form-label">Nama Lahan</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="lahan_nama" class="form-control" id="lahanNama"
                                                    required>
                                                <div class="invalid-feedback">Masukkan Nama lahan dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="lahanJenisTanah" class="form-label">Jenis Tanah</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="lahan_jenis_tanah" class="form-control"
                                                    id="lahanJenisTanah" required>
                                                <div class="invalid-feedback">Masukkan Jenis Tanah dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="lahanUkuran" class="form-label">Ukuran Lahan (m2)</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="lahan_ukuran" class="form-control"
                                                    id="lahanUkuran" required>
                                                <div class="invalid-feedback">Masukkan Ukuran dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="lahanKeterangan" class="form-label">Keterangan Lahan</label>
                                            <div class="input-group has-validation">
                                                <textarea type="text" name="lahan_keterangan" class="form-control"
                                                    id="lahanKeterangan" required></textarea>
                                                <div class="invalid-feedback">Masukkan Keterangan dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="lahanAktif" class="form-label">Status Lahan</label>
                                            <select name="lahan_aktif" class="form-select" id="lahanAktif" required>
                                                <option selected disabled>-- Pilih Status --</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="NonAktif">Non Aktif</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Status Lahan</div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">Tambah</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.jenis.lahan') }}"
                                                class="btn btn-secondary w-100">Kembali</a>
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
