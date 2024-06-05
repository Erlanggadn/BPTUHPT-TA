@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Sapi Siap Jual</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit</h5>
                        <form action="{{ route('sapi-jual.update', $sapiJual->id_jual) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="kode_sapi" class="form-label">Kode Sapi</label>
                                <select class="form-select" name="kode_sapi" id="kode_sapi" required>
                                    <option selected>Pilih Sapi</option>
                                    @foreach($sapis as $sapi)
                                    <option value="{{ $sapi->id }}" data-jenis="{{ $sapi->jenis }}"
                                        {{ $sapi->id == $sapiJual->kode_sapi ? 'selected' : '' }}>
                                        {{ $sapi->id }} - {{ $sapi->jenis }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_sapi" class="form-label">Jenis Sapi</label>
                                <input type="text" class="form-control" id="jenis_sapi" name="jenis_sapi"
                                    value="{{ $sapiJual->jenis_sapi }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="col-form-label">Status</label>
                                <select name="status" class="form-select" id="status" required>
                                    <option selected>Pilih Status</option>
                                    <option value="Siap Jual" {{ $sapiJual->status == 'Siap Jual' ? 'selected' : '' }}>
                                        Siap Jual</option>
                                    <option value="Belum Siap"
                                        {{ $sapiJual->status == 'Belum Siap' ? 'selected' : '' }}>Belum Siap</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_siap" class="form-label">Tanggal Siap Jual</label>
                                <input type="date" class="form-control" id="tgl_siap" name="tgl_siap"
                                    value="{{ $sapiJual->tgl_siap }}" required>
                            </div>
                            <a href="{{ route('sapi-jual.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Template Main JS File -->
<script src="{{ asset('js/main.js') }}"></script>
<script>
    document.getElementById('kode_sapi').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var jenisSapi = selectedOption.getAttribute('data-jenis');
        document.getElementById('jenis_sapi').value = jenisSapi;
    });

</script>
