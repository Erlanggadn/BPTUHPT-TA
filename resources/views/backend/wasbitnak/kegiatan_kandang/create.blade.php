@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Form Kegiatan Kandang</h5>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{ route('store.kegiatan.kandang') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Petugas Lapangan</div>
                                <div class="col-lg-9 col-md-10">
                                    <input name="kegiatan_orang_display" class="form-control"
                                        value="{{ $user->pegawai ? $user->pegawai->pegawai_nama : $user->name }}"
                                        disabled>
                                    <input type="hidden" name="kegiatan_orang"
                                        value="{{ $user->pegawai ? $user->pegawai->pegawai_id : '' }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Tipe Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="kegiatan_jenis_kandang" class="form-select">
                                        <option value="" selected disabled>Pilih Tipe Kandang</option>
                                        @foreach($jenisKandang as $jenis)
                                        <option value="{{ $jenis->kand_id }}">
                                            {{ $jenis->kand_id}} -
                                            [ {{ $jenis->jenisKandang->kandang_tipe }} -
                                            {{ $jenis->kand_nama }} ]
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Pelaksanaan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="kegiatan_tanggal" id="kegiatan_tanggal"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Mulai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="kegiatan_jam_mulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Selesai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="kegiatan_jam_selesai" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Kegiatan Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="kegiatan_keterangan" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Upload Foto</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="kegiatan_foto" class="form-control" id="kegiatan_foto">
                                    <img id="foto-preview" src="" alt="Foto Pratinjau" class="img-thumbnail mt-3"
                                        style="display: none; max-width: 200px;">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="kegiatan_status" class="form-select">
                                        <option value="" selected disabled>Pilih Status Kandang</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Belum Selesai">Belum Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="kode_sapi" class="form-label">Daftar Sapi</label>
                                <input type="text" id="search-sapi" class="form-control" placeholder="Cari Sapi...">
                                <div id="sapi-list" class="form-control" style="height: 200px; overflow-y: scroll;">
                                    <!-- Populate sapi list dynamically -->
                                    @foreach ($sapis as $sapi)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kode_sapi[]"
                                            value="{{ $sapi->sapi_id }}" id="sapi-{{ $sapi->sapi_id }}">
                                        <label class="form-check-label" for="sapi-{{ $sapi->sapi_id }}">
                                            {{ $sapi->sapi_id }} [{{ $sapi->sapi_status }}]
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success">Tambah Kegiatan</button>
                                <a href="{{ route('index.kegiatan.kandang') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Data kandang berhasil ditambahkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Search Sapi Script -->
    <script>
        document.getElementById('search-sapi').addEventListener('input', function () {
            let filter = this.value.toLowerCase();
            let sapiList = document.getElementById('sapi-list');
            let sapis = sapiList.getElementsByClassName('form-check');

            for (let i = 0; i < sapis.length; i++) {
                let label = sapis[i].getElementsByTagName('label')[0];
                let textValue = label.textContent || label.innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    sapis[i].style.display = '';
                } else {
                    sapis[i].style.display = 'none';
                }
            }
        });

        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('kegiatan_tanggal').setAttribute('min', today);
        });

        @if(session('success'))
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        @endif

        // Preview uploaded image
        document.getElementById('kegiatan_foto').addEventListener('change', function () {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('foto-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });

    </script>
</main>
