@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6  flex-column align-items-center justify-content-center">
                        <form action="{{ route('akunadmin.update', $akunuser->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Include a hidden field to store the previous URL -->
                            <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ubah Akun Pegawai</h5>
                                        <p class="text-center small">Pastikan Data Benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" value="{{ $akunuser->email }}" name="email"
                                                    class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Masukkan Email Pegawai dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Nama Pegawai</label>
                                            <div class="input-group has-validation">
                                                <input type="text" value="{{ $akunuser->name }}" name="name"
                                                    class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Masukkan Nama Pegawai dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">No. Hp Pegawai</label>
                                            <div class="input-group has-validation">
                                                <input type="number" value="{{ $akunuser->nohp }}" name="nohp"
                                                    class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Masukkan No.Hp Pegawai dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Alamat Pegawai</label>
                                            <div class="input-group has-validation">
                                                <input type="text" value="{{ $akunuser->alamat }}" name="alamat"
                                                    class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Masukkan Alamat Pegawai dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-form-label">Status Pegawai</label>
                                            <div class="">
                                                <select name="role" class="form-select" aria-label="Default select example">
                                                    <option selected>{{ $akunuser->role }}</option>
                                                    <option value="admin">admin</option>
                                                    <option value="wasbitnak">wasbitnak</option>
                                                    <option value="keswan">keswan</option>
                                                    <option value="ppid">ppid</option>
                                                    <option value="kepala">kepala</option>
                                                    <option value="bendahara">bendahara</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password Pegawai</label>
                                            <input type="password" value="{{ $akunuser->password }}" name="password"
                                                class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Masukkan Password Pegawai</div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit"><i
                                                    class="bi bi-box-arrow-in-right"></i> Simpan</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ url()->previous() }}" class="btn btn-outline-danger w-100"><i
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
