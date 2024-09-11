@include('layouts.utama.main')
@include('layouts.utama.main2')

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"></div>
                        <form action="{{ route('store.rumput') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Ketersediaan Rumput</h5>
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
                                        <div class="row mb-3">
                                            <label class="col-form-label">Jenis Rumput</label>
                                            <div class="">
                                                <select name="rum_id" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected disabled>-- Pilih Jenis --</option>
                                                    @foreach($jenisRumput as $jenis)
                                                    <option value="{{ $jenis->rum_id }}">{{ $jenis->rum_nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('rum_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="rumputBeratAwal" class="form-label">Berat Rumput Awal/Bibit
                                                (KG)</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="rumput_berat_awal" class="form-control"
                                                    id="rumputBeratAwal" required>
                                                <div class="invalid-feedback">Masukkan Berat Rumput Awal dengan benar
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="rumputMasuk" class="form-label">Tanggal Masuk Rumput</label>
                                            <div class="input-group has-validation">
                                                <input type="date" name="rumput_masuk" class="form-control"
                                                    id="rumputMasuk" required>
                                                <div class="invalid-feedback">Masukkan Tanggal Masuk Rumput dengan benar
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="rumputKeterangan" class="form-label">Keterangan</label>
                                            <div class="input-group has-validation">
                                                <textarea type="text" name="rumput_keterangan" class="form-control"
                                                    id="rumputKeterangan" required></textarea>
                                                <div class="invalid-feedback">Masukkan Keterangan dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="rumputStatus" class="form-label">Status Rumput</label>
                                            <select name="rumput_status" class="form-select" id="rumputStatus" required>
                                                <option selected disabled>-- Pilih Status --</option>
                                                <option value="Bibit">Bibit</option>
                                                <option value="Baru Ditanam">Baru Ditanam</option>
                                                <option value="Siap Panen">Siap Panen</option>
                                                <option value="Stok Habis">Stok Habis</option>
                                                <option value="Rusak/Tidak Layak">Rusak/Tidak Layak</option>
                                                <option value="Siap Jual">Siap Jual</option>
                                                <option value="Siap Makan">Siap Pakan</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Status Rumput</div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">Tambah</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.rumput') }}"
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