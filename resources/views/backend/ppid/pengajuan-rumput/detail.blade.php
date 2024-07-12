@include('layouts.utama.main2')
@include('layouts.ppid.navbar')
@include('layouts.ppid.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail Pengajuan Pembelian Rumput
                            ({{  $pengajuan->pembeli->pembeli_nama }})
                        </h5>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('update.ppid.prumput', $pengajuan->belirum_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Identitas Pembeli -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama </div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="belirum_orang" id="belirum_orang"
                                        value="{{ $pengajuan->belirum_orang }}">
                                    <input type="text" class="form-control"
                                        value="{{  $pengajuan->pembeli->pembeli_nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Asal Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="belirum_orang" id="belirum_orang" value="">
                                    <input type="text" class="form-control"
                                        value="{{  $pengajuan->pembeli->pembeli_instansi }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nomor HP Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="belirum_nohp" id="belirum_nohp" class="form-control"
                                        value="{{ $pengajuan->belirum_nohp }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alamat Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="belirum_alamat" id="belirum_alamat" class="form-control"
                                        value="{{ $pengajuan->belirum_alamat }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Surat Pengajuan</div>
                                <div class="col-lg-9 col-md-8 ">
                                    <input type="file" name="belirum_surat" id="belirum_surat"
                                        class="form-control mb-4">
                                    <a class="mb-4" href="{{ asset('uploads/' . $pengajuan->belirum_surat) }}"
                                        target="_blank"><span class="badge bg-primary">Lihat Surat</span></a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="belirum_tanggal" id="belirum_tanggal" class="form-control"
                                        value="{{ $pengajuan->belirum_tanggal }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belirum_alasan" id="belirum_alasan" class="form-control"
                                        required>{{ $pengajuan->belirum_alasan }}</textarea>
                                </div>
                            </div>
                            <h5 class="card-title">Status Pengajuan Pembelian
                            </h5>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="belirum_status" id="belirum_status" class="form-select" required>
                                        <option value="{{ $pengajuan->belirum_status }}"
                                            {{ $pengajuan->belirum_status ? 'selected' : '' }}>
                                            {{ $pengajuan->belirum_status }}</option>
                                        <option value="" disabled>-- Status Pembelian --</option>
                                        <option value="Disetujui">Disetujui</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Disposisi Kepala Balai</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belirum_keterangan" id="belirum_keterangan" class="form-control"
                                        required>{{ $pengajuan->belirum_keterangan }}</textarea>
                                </div>
                            </div>
                            <h5 class="card-title">Pengajuan Produk
                            </h5>

                            <!-- Detail Pengajuan -->
                            <div id="dynamic-field">
                                @foreach ($pengajuan->detailPengajuanRumput as $detail)
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_jenis[]" id="drumput_jenis" class="form-select" required>
                                            @foreach($rumputJenis as $jenis)
                                            <option value="{{ $jenis->rum_id }}"
                                                {{ $detail->detail_jenis == $jenis->rum_id ? 'selected' : '' }}>
                                                {{ $jenis->rum_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Kategori Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_kategori[]" id="drumput_kategori" class="form-select">
                                            <option value="{{ $detail->drumput_kategori }}">
                                                {{ $detail->drumput_kategori }} </option>
                                            <optgroup label="Benih dan HPT">
                                                <option value="Rumput Padang Pengembaalaan">Rumput Padang Pengembalaan
                                                </option>
                                                <option value="Rumput Potong">Rumput Potong</option>
                                                <option value="Rumput">Rumput</option>
                                                <option value="Leguminosa Pohon">Leguminosa Pohon</option>
                                                <option value="Leguminosa Menjalar">Leguminosa Menjalar</option>
                                            </optgroup>
                                            <optgroup label="Hasil Ikutan">
                                                <option value="Kompos">Kompos</option>
                                                <option value="Rumput Pakan Ternak">Rumput Pakan Ternak</option>
                                                <option value="Silase">Silase</option>
                                                <option value="Mineral Block">Mineral Block</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Berat Rumput (KG)</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="drumput_berat[]" id="drumput_berat"
                                            class="form-control" value="{{ $detail->drumput_berat }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Satuan Per</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_satuan[]" id="drumput_satuan" class="form-select">
                                            <option value="{{ $detail->drumput_satuan }}">{{ $detail->drumput_satuan }}
                                            </option>
                                            <option value="Per Pools">Per Pools</option>
                                            <option value="Per Stek">Per Stek</option>
                                            <option value="Per Biji">Per Biji</option>
                                            <option value="Per Batang">Per Batang</option>
                                            <option value="Per Kilogram">Per Kilogram</option>
                                            <option value="Per Stolon">Per Stolon</option>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <p class="badge bg-danger">*jika membeli lebih dari satu jenis</p>
                            <div class=" mb-4">
                                <button type="button" class="btn btn-primary" id="add-field">Tambah Jenis
                                    Rumput</button>
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success">Ubah Pengajuan</button>
                                <a href="{{ route('index.ppid.psapi') }}" class="btn btn-secondary">Kembali</a>
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
                    Data pengajuan berhasil diupdate.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Custom Scripts -->
    <script>
        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('belirum_tanggal').setAttribute('min', today);
        });

        @if(session('success'))
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        @endif

    </script>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dynamicField = document.getElementById('dynamic-field');
        var addFieldButton = document.getElementById('add-field');

        addFieldButton.addEventListener('click', function () {
            var clone = dynamicField.cloneNode(true);
            document.querySelector('form').insertBefore(clone, addFieldButton.parentElement);
        });
    });

</script>
