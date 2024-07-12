@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('daftar.save') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Daftarkan Akun Anda</h5>
                                        <p class="text-center small">Masukkan Data Anda dengan Benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="email" class="form-control" id="yourUsername"
                                                    required>
                                                <div class="invalid-feedback">Masukkan Email anda dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama Anda</label>
                                            <input type="text" name="pembeli_nama" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Masukkan Nama anda dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourInstansi" class="form-label">Asal Instansi</label>
                                            <input type="text" name="pembeli_instansi" class="form-control"
                                                id="yourInstansi" required>
                                            <div class="invalid-feedback">Masukkan Instansi anda dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourLahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="pembeli_lahir" class="form-control"
                                                id="yourTanggal Lahir" required>
                                            <div class="invalid-feedback">Masukkan Tanggal Lahir anda dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourNohp" class="form-label">No. Hp</label>
                                            <input type="number" name="pembeli_nohp" class="form-control" id="yourNohp"
                                                required>
                                            <div class="invalid-feedback">Masukkan No.Hp anda dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourAlamat" class="form-label">Alamat</label>
                                            <textarea type="text" name="pembeli_alamat" class="form-control"
                                                id="yourAlamat" required></textarea>
                                            <div class="invalid-feedback">Masukkan Alamat anda dengan benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Masukkan Password anda</div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="confirmPassword" required>
                                            <div class="invalid-feedback">Konfirmasi Password anda</div>
                                        </div>
                                        <div class="col-12">
                                            <input type="checkbox" id="showPasswordToggle">
                                            Tampilkan Password
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit"><i
                                                    class="bi bi-box-arrow-in-right"></i> Daftar</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="/" class="btn btn-outline-secondary w-100"><i
                                                    class="bi bi-house-door-fill"></i> Beranda</a>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah Punya Akun? <a
                                                    href="{{ route('loginpembeli') }}">Login</a></p>
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

<script>
    document.getElementById('showPasswordToggle').addEventListener('change', function () {
        var passwordField = document.getElementById('yourPassword');
        var confirmPasswordField = document.getElementById('confirmPassword');
        if (this.checked) {
            passwordField.type = 'text';
            confirmPasswordField.type = 'text';
        } else {
            passwordField.type = 'password';
            confirmPasswordField.type = 'password';
        }
    });

</script>
