@include('layouts.utama.main2')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6  flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div><!-- End Logo -->
                        <form action="{{ route('updatesiap', $rumputsi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ubah Status Rumput Siap Jual</h5>
                                        <p class="text-center small">Pastikan Data Benar!
                                        </p>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control" id="status" required>
                                            <option value="Siap Jual" {{ $rumputsi->status }}>Siap Jual</option>
                                            <option value="Siap Pakan" {{ $rumputsi->status}}>Siap Pakan</option>
                                        </select>
                                        <div class="invalid-feedback">Pilih status yang benar</div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <button class="btn btn-outline-success w-100" type="submit">Simpan</button>
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ route('indexrumputsiap') }}"
                                            class="btn btn-outline-secondary w-100">Kembali</a>
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
