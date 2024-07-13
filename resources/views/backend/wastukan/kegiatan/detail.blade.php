@extends('layouts.utama.main2')
@extends('layouts.wastukan.navbar')
@extends('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail & Edit Kegiatan Lahan</h5>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{ route('update.tanam', $kegiatan->tanam_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Pegawai Lapangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <p name="" class="" disabled>{{ $kegiatan->pegawai->pegawai_nama }}</p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Nama Rumput</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="tanam_detail_rumput" class="form-select" disabled>
                                        <option value="">Pilih Rumput</option>
                                        @foreach($jenisRumput as $rumput)
                                        <option value="{{ $rumput->rumput_id }}"
                                            {{ $rumput->rumput_id == $kegiatan->tanam_detail_rumput ? 'selected' : '' }}>
                                            {{ $rumput->rumput_id }} - [ {{ $rumput->jenisRumput->rum_nama }} -
                                            {{ $rumput->rumput_berat_awal }} KG ]
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama Lahan</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="tanam_detail_lahan" class="form-select" disabled>
                                        <option value="">Pilih Lahan</option>
                                        @foreach($jenisLahan as $lahan)
                                        <option value="{{ $lahan->lahan_id }}"
                                            {{ $lahan->lahan_id == $kegiatan->tanam_detail_lahan ? 'selected' : '' }}>
                                            {{ $lahan->lahan_id }} - {{ $lahan->lahan_nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Kegiatan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="tanam_tanggal" class="form-control"
                                        value="{{ $kegiatan->tanam_tanggal }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Mulai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="tanam_jam_mulai" class="form-control"
                                        value="{{ $kegiatan->tanam_jam_mulai }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Selesai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="tanam_jam_selesai" class="form-control"
                                        value="{{ $kegiatan->tanam_jam_selesai }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Rincian Kegiatan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="tanam_kegiatan" class="form-control"
                                        value="{{ $kegiatan->tanam_kegiatan }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Upload Foto Kegiatan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="tanam_foto" class="form-control">
                                    @if($kegiatan->tanam_foto)
                                    <img src="{{ asset('uploads/' . $kegiatan->tanam_foto) }}" alt="Foto Kegiatan"
                                        class="img-fluid mt-2">
                                    <a href="{{ asset('uploads/' . $kegiatan->tanam_foto) }}" download
                                        class="btn btn-outline-primary mt-2"><i class="bi bi-download"></i> Download
                                        Foto</a>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status Kegiatan</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="tanam_status" class="form-select">
                                        <option value="Selesai"
                                            {{ $kegiatan->tanam_status == 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="Proses"
                                            {{ $kegiatan->tanam_status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Belum Selesai"
                                            {{ $kegiatan->tanam_status == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                            Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-outline-success">Ubah</button>
                                <a href="{{ route('index.tanam') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="{{ asset ('js/main.js') }}"></script>
