@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 flex-column align-items-center justify-content-center">
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
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                        @endif

                        <form action="{{ route('store.sapi') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Data Ternak Baru Lahir</h5>
                                        <p class="text-center small">Pastikan Data Diisi dengan Benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="mb-3">
                                            <label class="col-form-label">Jenis Hewan Ternak</label>
                                            <div class="">
                                                <select name="sapi_jenis" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Pilih Jenis</option>
                                                    @foreach($jenisSapi as $jenis)
                                                    <option value="{{ $jenis->sjenis_id }}">{{ $jenis->sjenis_nama }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('sapi_jenis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="yourUsername" class="form-label">Urutan Lahir</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="sapi_urutan_lahir" class="form-control"
                                                    id="yourUsername" required>
                                                @error('sapi_urutan_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="yourUsername" class="form-label">Tanggal Lahir</label>
                                            <div class="input-group has-validation">
                                                <input type="date" name="sapi_tanggal_lahir" class="form-control"
                                                    id="yourUsername" required>
                                                @error('sapi_tanggal_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="yourUsername" class="form-label">No.ID Induk</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="sapi_no_induk" class="form-control"
                                                    id="yourUsername" required>
                                                @error('sapi_no_induk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="yourUsername" class="form-label">Keterangan</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="sapi_keterangan" class="form-control"
                                                    id="yourUsername" required>
                                                @error('sapi_keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="sapi_kelamin">Jenis Kelamin</label>
                                            <select name="sapi_kelamin" id="sapi_kelamin" class="form-control" required>
                                                <option value="">Pilih Jenis</option>
                                                <option value="Jantan">Jantan</option>
                                                <option value="Betina">Betina</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="sapi_status">Status Sapi</label>
                                            <select name="sapi_status" id="sapi_status" class="form-control" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Hamil">Hamil</option>
                                                <option value="Menyusui">Menyusui</option>
                                                <option value="Dijual">Dijual</option>
                                                <option value="Terjual">Terjual</option>
                                                <option value="Produktif">Produktif</option>
                                                <option value="Pemeriksaan">Pemeriksaan</option>
                                                <option value="Karantina">Karantina</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit"><i
                                                    class="bi bi-box-arrow-in-right"></i> Daftarkan Identitas</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.sapi') }}"
                                                class="btn btn-outline-secondary w-100"><i
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
