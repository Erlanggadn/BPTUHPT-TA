@include('layouts.utama.main2')
@include('layouts.ppid.navbar')
@include('layouts.ppid.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="card-title">Detail Harga Rumput</h5>
                <form action="{{ route('update.harga.rumput', $hargaRumput->hr_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Jenis Rumput</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="rum_id" class="form-control">
                                @foreach ($jenisRumput as $jenis)
                                <option value="{{ $jenis->rum_id }}" {{ $hargaRumput->rum_id == $jenis->rum_id ?
                                    'selected' : '' }}>{{ $jenis->rum_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Jenis Pakan</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="hr_jenis" class="form-select">
                                <option value="" disabled>Pilih Jenis Pakan</option>
                                <option value="Benih dan HPT" {{ $hargaRumput->hr_jenis == 'Benih dan HPT' ? 'selected'
                                    : '' }}>Benih dan HPT</option>
                                <option value="Hasil Ikutan" {{ $hargaRumput->hr_jenis == 'Hasil Ikutan' ? 'selected' :
                                    '' }}>Hasil Ikutan</option>
                            </select>
                            @error('hr_jenis')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Kategori</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" name="hr_kategori" class="form-control"
                                value="{{ $hargaRumput->hr_kategori }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Satuan</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" name="hr_satuan" class="form-control"
                                value="{{ $hargaRumput->hr_satuan }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Harga</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="number" name="hr_harga" class="form-control"
                                value="{{ $hargaRumput->hr_harga }}">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Perbarui</button>
                        <a href="{{ route('index.harga.rumput') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>

                <form action="{{ route('delete.harga.rumput', $hargaRumput->hr_id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </section>
</main>