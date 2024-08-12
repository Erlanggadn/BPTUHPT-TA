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
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sapi_urutan_lahir" class="form-label">Urutan Lahir</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="sapi_urutan_lahir" class="form-control"
                                                    id="sapi_urutan_lahir">
                                                @error('sapi_urutan_lahir')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sapi_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <div class="input-group has-validation">
                                                <input type="date" name="sapi_tanggal_lahir" class="form-control"
                                                    id="sapi_tanggal_lahir">
                                                @error('sapi_tanggal_lahir')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sapi_no_induk" class="form-label">No.ID Induk</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="sapi_no_induk" class="form-control"
                                                    id="sapi_no_induk">
                                                @error('sapi_no_induk')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sapi_keterangan" class="form-label">Keterangan</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="sapi_keterangan" class="form-control"
                                                    id="sapi_keterangan">
                                                @error('sapi_keterangan')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="sapi_kelamin">Jenis Kelamin</label>
                                            <select name="sapi_kelamin" id="sapi_kelamin" class="form-control">
                                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="Jantan">Jantan</option>
                                                <option value="Betina">Betina</option>
                                            </select>
                                            @error('sapi_kelamin')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="sapi_status">Status Sapi</label>
                                            <select name="sapi_status" id="sapi_status" class="form-control">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="Baru Lahir">Baru Lahir</option>
                                                <option value="Produktif">Produktif</option>
                                                <option value="Pemeriksaan">Pemeriksaan</option>
                                                <option value="Karantina">Karantina</option>
                                            </select>
                                            @error('sapi_status')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">Daftarkan
                                                Identitas</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.sapi') }}"
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
