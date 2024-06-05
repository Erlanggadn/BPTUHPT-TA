@include('layouts.utama.main2')

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                        <form action="{{ route('update.jenis.kandang', $jenisKandang->id_kandang) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Edit Status Jenis Kandang</h5>
                                        <p class="text-center small">Pastikan data yang Anda masukkan benar!</p>
                                    </div>

                                    <div class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="status" required>
                                                <option value="Aktif" {{ $jenisKandang->status}}>Aktif</option>
                                                <option value="Tidak Aktif" {{ $jenisKandang->status }}>Tidak Aktif
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">Pilih status yang benar</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-outline-success w-100" type="submit">Ubah</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ url('/wasbitnak') }}"
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
