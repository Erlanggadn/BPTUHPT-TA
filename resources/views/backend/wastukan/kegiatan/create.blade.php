@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Form Kegiatan Lahan</h5>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{ route('store.tanam') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Pegawai</div>
                                <div class="col-lg-9 col-md-10">
                                    <input name="kegiatan_orang_display" class="form-control" value="{{ $user->pegawai ? $user->pegawai->pegawai_nama : $user->name }}" disabled>
                                    <input type="hidden" name="kegiatan_orang" value="{{ $user->pegawai ? $user->pegawai->pegawai_id : '' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Rumput</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="tanam_detail_rumput" class="form-select" required>
                                        <option value="">Pilih Rumput</option>
                                        @foreach($jenisRumput as $rumput)
                                        <option value="{{ $rumput->rumput_id }}">{{ $rumput->rumput_id }} -
                                            {{ $rumput->jenisRumput->rum_nama }} [{{ $rumput->rumput_berat_awal }} KG]
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Lahan</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="tanam_detail_lahan" class="form-select" required>
                                        <option value="">Pilih Lahan</option>
                                        @foreach($jenisLahan as $lahan)
                                        <option value="{{ $lahan->lahan_id }}">{{ $lahan->lahan_nama }} -
                                            {{ $lahan->lahan_jenis_tanah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="tanam_tanggal" id="tanam_tanggal" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Mulai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="tanam_jam_mulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Waktu Selesai</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="time" name="tanam_jam_selesai" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Kegiatan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="tanam_kegiatan" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Upload Foto</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="tanam_foto" class="form-control" required
                                        onchange="previewImage(event)">
                                    <img id="preview" src="#" alt="Image preview"
                                        style="display: none; max-width: 100%; height: auto; margin-top: 10px;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="tanam_status" class="form-select" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Belum Selesai">Belum Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-outline-success">Tambah Kegiatan</button>
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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("tanam_tanggal").setAttribute('min', today);
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

</script>
