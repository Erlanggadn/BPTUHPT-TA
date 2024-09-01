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
                        <form action="{{ route('store.harga.sapi') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Harga Sapi</h5>
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
                                        <label for="hs_jenis" class="form-label">Jenis Sapi</label>
                                        <select name="hs_jenis" class="form-control" id="hs_jenis">
                                            <option selected disabled>-- Pilih Jenis Sapi --</option>
                                            @foreach($jenisSapi as $jenis)
                                            <option value="{{ $jenis->sjenis_id }}">{{ $jenis->sjenis_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('hs_jenis')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                    <div class="col-12">
                                        <label for="hs_kelamin" class="form-label">Gender</label>
                                        <select name="hs_kelamin" class="form-control" id="hs_kelamin">
                                            <option value="" selected disabled>-- Pilih Gender --</option>
                                            <option value="Betina">
                                                Betina</option>
                                            <option value="Jantan">
                                                Jantan</option>
                                        </select>
                                        @error('hs_kelamin')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="hs_kategori" class="form-label">Kategori</label>
                                        <input type="text" name="hs_kategori" class="form-control" id="hs_kategori"
                                            value="{{ old('hs_kategori') }}">
                                    </div>
                                    @error('hs_kategori')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror

                                    <div class="col-12">
                                        <label for="hs_harga" class="form-label">Harga (Rp)</label>
                                        <input type="number" name="hs_harga" class="form-control" id="hs_harga"
                                            value="{{ old('hs_harga') }}">
                                    </div>
                                    @error('hs_harga')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror

                                    <br>
                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit">Tambah Harga Sapi</button>
                                    </div>
                                    <br>
                                    <div class="col-12">
                                        <a href="{{ route('index.harga.sapi') }}"
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