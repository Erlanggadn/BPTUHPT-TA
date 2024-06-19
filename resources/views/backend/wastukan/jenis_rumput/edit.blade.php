@include('layouts.utama.main')
@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div>
                        <form action="{{ route('update.jenis.rumput', ['rum_id' => $jenisRumput->rum_id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Edit Jenis Rumput</h5>
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
                                                    value="{{ $jenisRumput->rum_nama }}" required>
                                                <div class="invalid-feedback">Masukkan Nama Rumput dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="rumKeterangan" class="form-label">Keterangan</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="rum_keterangan" class="form-control"
                                                    id="rumKeterangan" value="{{ $jenisRumput->rum_keterangan }}"
                                                    required>
                                                <div class="invalid-feedback">Masukkan Keterangan dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="rumAktif" class="form-label">Aktif</label>
                                            <select name="rum_aktif" class="form-select" id="rumAktif" required>
                                                <option selected disabled>Pilih Status</option>
                                                <option value="Aktif"
                                                    {{ $jenisRumput->rum_aktif == 'Aktif' ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="NonAktif"
                                                    {{ $jenisRumput->rum_aktif == 'NonAktif' ? 'selected' : '' }}>Non
                                                    Aktif
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Status Rumput</div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit"><i
                                                    class="bi bi-box-arrow-in-right"></i> Simpan</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.jenis.rumput') }}"
                                                class="btn btn-outline-secondary w-100"><i
                                                    class="bi bi-house-door-fill"></i> Kembali</a>
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
