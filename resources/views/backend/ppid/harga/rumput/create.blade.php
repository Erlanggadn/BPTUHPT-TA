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
                        <form action="{{ route('store.harga.rumput') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Harga rumput</h5>
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

                                    <div class="col-12">
                                        <label for="rum_id" class="form-label">Jenis Rumput</label>
                                        <select name="rum_id" class="form-control" id="rum_id">
                                            <option selected disabled>-- Pilih Jenis Rumput --</option>
                                            @foreach($jenisRumput as $jenis)
                                            <option value="{{ $jenis->rum_id }}">{{ $jenis->rum_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('rum_id')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                    <div class="col-12">
                                        <label for="hr_jenis" class="form-label">Jenis Pakan</label>
                                        <select name="hr_jenis" class="form-select" id="hr_jenis">
                                            <option value="" disabled selected>-- Pilih Jenis Pakan --</option>
                                            <option value="Benih dan HPT" {{ old('hr_jenis')=='Benih dan HPT'
                                                ? 'selected' : '' }}>Benih dan HPT</option>
                                            <option value="Hasil Ikutan" {{ old('hr_jenis')=='Hasil Ikutan' ? 'selected'
                                                : '' }}>Hasil Ikutan</option>
                                        </select>
                                        @error('hr_jenis')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="hr_satuan" class="form-label">Satuan (Per)</label>
                                        <input type="text" name="hr_satuan" class="form-control" id="hr_satuan"
                                            value="{{ old('hr_satuan') }}">
                                    </div>
                                    @error('hr_satuan')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror

                                    <div class="col-12">
                                        <label for="hr_kategori" class="form-label">Kategori</label>
                                        <input type="text" name="hr_kategori" class="form-control" id="hr_kategori"
                                            value="{{ old('hr_kategori') }}">
                                    </div>
                                    @error('hr_kategori')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror

                                    <div class="col-12">
                                        <label for="hr_harga" class="form-label">Harga (Rp)</label>
                                        <input type="number" name="hr_harga" class="form-control" id="hr_harga"
                                            value="{{ old('hr_harga') }}">
                                    </div>
                                    @error('hr_harga')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror

                                    <br>
                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit">Tambah Harga Rumput</button>
                                    </div>
                                    <br>
                                    <div class="col-12">
                                        <a href="{{ route('index.harga.rumput') }}"
                                            class="btn btn-secondary w-100">Kembali</a>
                                    </div>
                                    <br>
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