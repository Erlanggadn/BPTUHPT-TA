@include('layouts.utama.main2')

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
                        {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif --}}
                    <form action="{{ route('post.jenis.kegiatan') }}" method="POST">
                        @csrf
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Tambah Kegiatan Kandang</h5>
                                    <p class="text-center small">Pastikan data yang Anda masukkan benar!</p>
                                </div>
                                <div class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="kode_kandang" class="form-label">ID Kandang</label>
                                        <select name="kode_kandang" class="form-control" id="kode_kandang">
                                            <option selected>Pilih Kandang</option>
                                            @if($jenisKandangs->isEmpty())
                                            <option value="" disabled>Tidak ada Kandang Sapi</option>
                                            @else
                                            @foreach($jenisKandangs as $jenisKandang)
                                            <option value="{{ $jenisKandang->id_kandang }}">
                                                {{ $jenisKandang->id_kandang }} - {{ $jenisKandang->jenis_kandang }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('kode_kandang')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <div class="invalid-feedback">Pilih kandang yang benar</div> --}}
                                    </div>
                                    <div class="col-12">
                                        <label for="kegiatan" class="form-label">Kegiatan</label>
                                        <input type="text" name="kegiatan" class="form-control" id="kegiatan">
                                        @error('kegiatan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="Diproses">Diproses</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="kode_sapi" class="form-label">Sapi</label>
                                        <input type="text" id="search-sapi" class="form-control"
                                            placeholder="Cari Sapi...">
                                        <div id="sapi-list" class="form-control"
                                            style="height: 200px; overflow-y: scroll;">
                                            @foreach($sapis as $sapi)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="kode_sapi[]"
                                                    value="{{ $sapi->id }}" id="sapi-{{ $sapi->id }}">
                                                <label class="form-check-label" for="sapi-{{ $sapi->id }}">
                                                    {{ $sapi->id }} - {{ $sapi->jenis }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        @error('kode_sapi')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @error('kode_sapi.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-outline-success w-100" type="submit">Simpan</button>
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ route('indexkegiatankandang') }}"
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
    document.getElementById('search-sapi').addEventListener('keyup', function () {
        var searchQuery = this.value.toLowerCase();
        var sapiList = document.getElementById('sapi-list');
        var sapiItems = sapiList.getElementsByClassName('form-check');

        for (var i = 0; i < sapiItems.length; i++) {
            var sapiLabel = sapiItems[i].getElementsByTagName('label')[0];
            var sapiText = sapiLabel.textContent || sapiLabel.innerText;

            if (sapiText.toLowerCase().indexOf(searchQuery) > -1) {
                sapiItems[i].style.display = "";
            } else {
                sapiItems[i].style.display = "none";
            }
        }
    });

</script>
