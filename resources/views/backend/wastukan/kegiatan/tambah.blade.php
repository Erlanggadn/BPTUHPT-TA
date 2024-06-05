@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"></div>
                        <form action="{{ route('storelogbook') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Wastukan</h5>
                                        <p class="text-center small">Masukkan Data dengan Benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="nomor_lahan" class="form-label"><b>Nomor Lahan</b></label>
                                            <input type="text" name="nomor_lahan" class="form-control" id="nomor_lahan"
                                                required>
                                            <div class="invalid-feedback">Masukkan nomor lahan dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="kode_pakan" class="form-label"><b>Kode Pakan</b></label>
                                            <select name="kode_pakan" class="form-control" id="kode_pakan" required>
                                                @foreach($rumputs as $item)
                                                <option value="{{ $item->kode_rumput }}">{{ $item->kode_rumput }} -
                                                    {{ $item->jenis_rumput }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Pilih kode pakan dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="tanggal_tanam" class="form-label"><b>Tanggal Tanam</b></label>
                                            <input type="date" name="tanggal_tanam" class="form-control"
                                                id="tanggal_tanam" required>
                                            <div class="invalid-feedback">Masukkan tanggal tanam dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="tanggal_panen" class="form-label"><b>Tanggal Panen</b></label>
                                            <input type="date" name="tanggal_panen" class="form-control"
                                                id="tanggal_panen">
                                            <div class="invalid-feedback">Masukkan tanggal panen dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="kegiatan" class="form-label"><b>Kegiatan yang
                                                    dilakukan</b></label>
                                            <textarea id="kegiatan" class="form-control" name="kegiatan"
                                                style="height: 100px" required></textarea>
                                            <div class="invalid-feedback">Masukkan kegiatan dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="berat" class="form-label"><b>Berat (KG)</b></label>
                                            <input type="number" name="berat" class="form-control" id="berat" required>
                                            <div class="invalid-feedback">Masukkan berat dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="stats" class="form-label"><b>Status</b></label>
                                            <select name="status" class="form-control" id="status" required>
                                                <option value="Sedang Berlangsung">Sedang Berlangsung</option>
                                                <option value="Selesai">Selesai Panen</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih kode pakan dengan benar</div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="pesan" class="form-label"><b>Pesan</b></label>
                                            <input type="text" name="pesan" class="form-control" id="pesan">
                                            <div class="invalid-feedback">Masukkan pesan dengan benar</div>
                                        </div>
                                        <div class="col-12 ">
                                            <button class="btn btn-outline-success w-100" type="submit">Tambah</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ route('wastukan') }}"
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
