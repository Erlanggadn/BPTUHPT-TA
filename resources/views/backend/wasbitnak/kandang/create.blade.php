@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div><!-- End Logo -->
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
                        <form action="{{ route('store.kandang') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Data Kandang</h5>
                                        <p class="text-center small">Pastikan Data Diisi dengan Benar!</p>
                                    </div>
                                    <div class="row-12 g-3 needs-validation" novalidate>
                                        <div class="row mb-3">
                                            <label class="col-form-label">Jenis Kandang</label>
                                            <div class="">
                                                <select name="kand_jenis" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Pilih Jenis/Tipe</option>
                                                    @foreach($jenisKandang as $jenis)
                                                    <option value="{{ $jenis->kandang_id }}">{{ $jenis->kandang_tipe }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('kand_jenis')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}
                                        </div>
                                        @enderror
                                        <div class="row-12 ">
                                            <label for="yourUsername" class="form-label">Nama Kandang</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="kand_nama" class="form-control"
                                                    id="yourUsername">
                                            </div>
                                        </div>
                                        @error('kand_nama')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}
                                        </div>
                                        @enderror
                                        <div class="row-12 ">
                                            <label for="yourUsername" class="form-label">Keterangan</label>
                                            <div class="input-group has-validation">
                                                <textarea type="text" name="kand_keterangan" class="form-control"
                                                    id="yourUsername"></textarea>
                                                <div class="invalid-feedback">Masukkan Data dengan benar</div>
                                            </div>
                                        </div>
                                        @error('kand_keterangan')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}
                                        </div>
                                        @enderror
                                        <div class="col-12">
                                            <label for="kandAktif" class="form-label">Status Kandang</label>
                                            <select name="kand_aktif" class="form-select" id="kandAktif" required>
                                                <option selected disabled>Pilih Status</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="NonAktif">Non Aktif</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Status Rumput</div>
                                        </div>
                                        @error('kand_aktif')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}
                                        </div>
                                        @enderror
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">Tambah Kandang</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.kandang') }}"
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