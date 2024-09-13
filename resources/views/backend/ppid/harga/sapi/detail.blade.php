@include('layouts.utama.main2')
@include('layouts.ppid.navbar')
@include('layouts.ppid.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="card-title">Detail Harga Sapi</h5>
                <form action="{{ route('update.harga.sapi', $hargaSapi->hs_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Jenis Sapi</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="sjenis_id" class="form-control">
                                @foreach ($jenisSapi as $jenis)
                                <option value="{{ $jenis->sjenis_id }}" {{ $hargaSapi->sjenis_id == $jenis->sjenis_id ? 'selected' : '' }}>{{ $jenis->sjenis_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Kategori</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" name="hs_kategori" class="form-control" value="{{ $hargaSapi->hs_kategori }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" name="hs_kelamin" class="form-control" value="{{ $hargaSapi->hs_kelamin }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Harga</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="number" name="hs_harga" class="form-control" value="{{ $hargaSapi->hs_harga }}">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Perbarui</button>
                        <a href="{{ route('index.harga.sapi') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>

                <form action="{{ route('delete.harga.sapi', $hargaSapi->hs_id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </section>
</main>
