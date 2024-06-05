@include('layouts.utama.main2')

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                        <form action="{{ route('post.jenis.kandang') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Jenis Kandang</h5>
                                        <p class="text-center small">Pastikan data yang Anda masukkan benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="no_kandang" class="form-label">Nomor Kandang</label>
                                            <input type="text" name="no_kandang" class="form-control" id="no_kandang"
                                                required>
                                            <div class="invalid-feedback">Masukkan nomor kandang yang benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="jenis_kandang" class="form-label">Jenis Kandang</label>
                                            <input type="text" name="jenis_kandang" class="form-control"
                                                id="jenis_kandang" required>
                                            <div class="invalid-feedback">Masukkan jenis kandang yang benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="status" required>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih status yang benar</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit">Simpan</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ url('wasbitnak') }}"
                                                class="btn btn-outline-secondary w-100">Beranda</a>
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
