@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"></div>
                        <form action="{{ route('pembeli.save') }}" method="POST">
                            @csrf
                            <div>
                                @if (Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                    <button class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    <button class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>
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
                                                @error ('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Nama Anda</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="name" class="form-control" id="yourUsername"
                                                    required>
                                                @error ('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">No. Hp</label>
                                            <div class="input-group has-validation">
                                                <input type="number" name="nohp" class="form-control" id="yourUsername"
                                                    required>
                                                @error ('nohp')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Alamat</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="alamat" class="form-control" id="yourUsername"
                                                    required>
                                                @error ('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourTanggalLahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                id="yourTanggalLahir" required>
                                            @error ('tanggal_lahir')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            @error ('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPasswordConfirmation" class="form-label">Konfirmasi
                                                Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="yourPasswordConfirmation" required>
                                            @error ('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            <p class="small mb-0">Sudah Punya Akun?<a
                                                    href="{{ route('pembeli.login') }}"> Login</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
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
