@extends('layouts.utama.main2')
@extends('layouts.wasbitnak.navbar')
@extends('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail & Edit Kegiatan Kandang</h5>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{ route('update.kegiatan.kandang', $kegiatan->kegiatan_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Pegawai</div>
                                <div class="col-lg-9 col-md-8">
                                    <p name="" class="" disabled>{{ $kegiatan->pegawai->pegawai_nama }}</p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Tipe Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="kegiatan_jenis_kandang" class="form-select">
                                        <option value="" disabled>Pilih Tipe Kandang</option>
                                        @foreach($jenisKandang as $jenis)
                                        <option value="{{ $jenis->kand_id }}"
                                            {{ $jenis->kand_id == $kegiatan->kegiatan_jenis_kandang ? 'selected' : '' }}>
                                            {{ $jenis->kand_id }} - [ {{ $jenis->jenisKandang->kandang_tipe }} -
                                            {{ $jenis->kand_nama }} ]
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="kegiatan_tanggal" class="form-control"
                                        value="{{ $kegiatan->kegiatan_tanggal }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Mulai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="kegiatan_jam_mulai" class="form-control"
                                        value="{{ $kegiatan->kegiatan_jam_mulai }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Selesai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="kegiatan_jam_selesai" class="form-control"
                                        value="{{ $kegiatan->kegiatan_jam_selesai }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Kegiatan Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="kegiatan_keterangan"
                                        class="form-control">{{ $kegiatan->kegiatan_keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Upload Foto</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="kegiatan_foto" class="form-control">
                                    <img src="{{ asset('storage/' . $kegiatan->kegiatan_foto) }}" alt="Foto Kegiatan"
                                        class="img-fluid mt-2">
                                    <a href="{{ asset('storage/' . $kegiatan->kegiatan_foto) }}" download
                                        class="btn btn-outline-primary mt-2"><i class="bi bi-download"></i> Download
                                        Foto</a>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="kegiatan_status" class="form-select">
                                        <option value="Selesai"
                                            {{ $kegiatan->kegiatan_status == 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="Proses"
                                            {{ $kegiatan->kegiatan_status == 'Proses' ? 'selected' : '' }}>Proses
                                        </option>
                                        <option value="Belum Selesai"
                                            {{ $kegiatan->kegiatan_status == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                            Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="kode_sapi" class="form-label">Daftar Kode Sapi</label>
                                <input type="text" id="search-sapi" class="form-control" placeholder="Cari Sapi...">
                                <div id="sapi-list" class="form-control" style="height: 200px; overflow-y: scroll;">
                                    @foreach ($sapis as $sapi)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kode_sapi[]"
                                            value="{{ $sapi->sapi_id }}"
                                            {{ in_array($sapi->sapi_id, $selectedSapi) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $sapi->sapi_id }}
                                            [{{ $sapi->sapi_status }}]</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success">Ubah Kegiatan</button>
                                <a href="{{ route('index.kegiatan.kandang') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dateInput = document.querySelector('input[name="kegiatan_tanggal"]');
            // You can add additional JavaScript logic here if needed
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var searchInput = document.getElementById('search-sapi');
            var sapiList = document.getElementById('sapi-list');

            searchInput.addEventListener('keyup', function () {
                var filter = searchInput.value.toLowerCase();
                var checkboxes = sapiList.getElementsByClassName('form-check');

                for (var i = 0; i < checkboxes.length; i++) {
                    var label = checkboxes[i].getElementsByClassName('form-check-label')[0];
                    var text = label.textContent || label.innerText;

                    if (text.toLowerCase().indexOf(filter) > -1) {
                        checkboxes[i].style.display = "";
                    } else {
                        checkboxes[i].style.display = "none";
                    }
                }
            });
        });

    </script>

</main>
