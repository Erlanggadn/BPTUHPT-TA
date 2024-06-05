@include('layouts.utama.main2')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <!-- Logo Here -->
                        </div>
                        <form action="{{ route('siapjual.store') }}" method="POST">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Rumput Siap Jual</h5>
                                        <p class="text-center small">Pastikan data yang Anda masukkan benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="id_wastukan" class="form-label">Daftar Rumput</label>
                                            <select name="id_wastukan" class="form-control" id="id_wastukan" required>
                                                @foreach($wastukans as $wastukan)
                                                <option value="{{ $wastukan->id }}">{{ $wastukan->id }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Pilih rumput yang benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" id="tanggal"
                                                required>
                                            <div class="invalid-feedback">Masukkan tanggal yang benar</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" class="form-control" id="status" required>
                                                <option value="Siap Jual">Siap Jual</option>
                                                <option value="Siap Pakan">Siap Pakan</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih status yang benar</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit">Simpan</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ route('indexrumputsiap') }}"
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
