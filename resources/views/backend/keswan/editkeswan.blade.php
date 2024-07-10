@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"></div><!-- End Logo -->
                        <form action="{{ route('update.profil.keswan', $akunuser->id) }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                                <input type="text" value="{{ old('email', $akunuser->email) }}"
                                                    name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="yourUsername">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">NIP Pegawai</label>
                                            <div class="input-group has-validation">
                                                <input type="text"
                                                    value="{{ old('pegawai_nip', $akunuser->pegawai->pegawai_nip ?? '') }}"
                                                    name="pegawai_nip"
                                                    class="form-control @error('pegawai_nip') is-invalid @enderror"
                                                    id="yourUsername">
                                                @error('pegawai_nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Nama Pegawai</label>
                                            <div class="input-group has-validation">
                                                <input type="text"
                                                    value="{{ old('pegawai_nama', $akunuser->pegawai->pegawai_nama ?? '') }}"
                                                    name="pegawai_nama"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="yourUsername">
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">No. Hp Pegawai</label>
                                            <div class="input-group has-validation">
                                                <input type="number"
                                                    value="{{ old('pegawai_nohp', $akunuser->pegawai->pegawai_nohp ?? '') }}"
                                                    name="pegawai_nohp"
                                                    class="form-control @error('nohp') is-invalid @enderror"
                                                    id="yourUsername">
                                                @error('nohp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Alamat Pegawai</label>
                                            <div class="input-group has-validation">
                                                <input type="text"
                                                    value="{{ old('pegawai_alamat', $akunuser->pegawai->pegawai_alamat ?? '') }}"
                                                    name="pegawai_alamat"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    id="yourUsername">
                                                @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="changePasswordCheckbox">
                                                <label class="form-check-label" for="changePasswordCheckbox">
                                                    Perbarui Password
                                                </label>
                                            </div>
                                        </div>
                                        <div id="passwordFields" style="display:none;">
                                            <div class="col-12">
                                                <label for="currentPassword" class="form-label">Password Lama</label>
                                                <input type="password" name="current_password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    id="currentPassword">
                                                @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="newPassword" class="form-label">Password Baru</label>
                                                <input type="password" name="new_password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    id="newPassword">
                                                @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="confirmNewPassword" class="form-label">Konfirmasi Password
                                                    Baru</label>
                                                <input type="password" name="new_password_confirmation"
                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                    id="confirmNewPassword">
                                                @error('new_password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="showPassword">
                                                    <label class="form-check-label" for="showPassword">
                                                        Tampilkan Password
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">Simpan</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('profilkeswan', $akunuser->id) }}"
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
<script src="{{ asset ('js/main.js') }}"></script>

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
    document.getElementById('showPassword').addEventListener('change', function (e) {
        let newPassword = document.getElementById('newPassword');
        let confirmNewPassword = document.getElementById('confirmNewPassword');
        if (this.checked) {
            newPassword.type = 'text';
            confirmNewPassword.type = 'text';
        } else {
            newPassword.type = 'password';
            confirmNewPassword.type = 'password';
        }
    });

    document.getElementById('changePasswordCheckbox').addEventListener('change', function (e) {
        let passwordFields = document.getElementById('passwordFields');
        if (this.checked) {
            passwordFields.style.display = 'block';
        } else {
            passwordFields.style.display = 'none';
        }
    });

</script>
