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
                        <form action="{{ route('update.jenis.kandang', ['kandang_id' => $jenisKandang->kandang_id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Edit Jenis Kandang</h5>
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
                                    @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first() }}
                                    </div>
                                    @endif
                                    <form class="row g-3 needs-validation" novalidate>
                                        <div class="col-12 mb-4">
                                            <label for="kandangtipe" class="form-label">Tipe Kandang</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="kandang_tipe" class="form-control"
                                                    id="kandangtipe" value="{{ $jenisKandang->kandang_tipe }}" required>
                                                <div class="invalid-feedback">Masukkan Tipe Kandang dengan benar</div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="kandangKeterangan" class="form-label">Keterangan</label>
                                            <div class="input-group has-validation">
                                                <textarea type="text" name="kandang_keterangan" class="form-control"
                                                    id="kandangKeterangan"
                                                    value="{{ $jenisKandang->kandang_keterangan }}" required></textarea>
                                                <div class="invalid-feedback">Masukkan Keterangan dengan benar</div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">Simpan</button>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <a href="{{ route('index.jenis.kandang') }}"
                                                class="btn btn-secondary w-100">Kembali</a>
                                        </div>
                                        <br>
                                    </form>
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

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
