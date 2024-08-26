@include('layouts.utama.main2')
@include('layouts.kepala.navbar')
@include('layouts.kepala.sidebar')

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
                        <form action="{{ route('update.kepala.prumput', $pengajuan->belirum_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Identitas Pembeli -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama </div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{  $pengajuan->pembeli->pembeli_nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Asal Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{  $pengajuan->pembeli->pembeli_instansi }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nomor HP Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $pengajuan->belirum_nohp }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alamat Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $pengajuan->belirum_alamat }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Surat Pengajuan</div>
                                <div class="col-lg-9 col-md-8 ">
                                    <a class="mb-4" href="{{ asset('uploads/' . $pengajuan->belirum_surat) }}"
                                        target="_blank"><span class="badge bg-primary">Lihat Surat</span></a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" class="form-control" value="{{ $pengajuan->belirum_tanggal }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea class="form-control" disabled>{{ $pengajuan->belirum_alasan }}</textarea>
                                </div>
                            </div>

                            <!-- Detail Pengajuan -->
                            <div id="dynamic-field">
                                @foreach ($pengajuan->detailPengajuanRumput as $detail)
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select class="form-select" disabled>
                                            @foreach($rumputJenis as $jenis)
                                            <option value="{{ $jenis->rum_id }}"
                                                {{ $detail->drumput_jenis == $jenis->rum_id ? 'selected' : '' }}>
                                                {{ $jenis->rum_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Kategori Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select class="form-select" disabled>
                                            <option value="B">{{ $detail->drumput_kategori}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Berat (KG)</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" class="form-control" value="{{ $detail->drumput_berat }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Satua Per</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select class="form-select" disabled>
                                            <option value="">{{ $detail->drumput_satuan}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Form untuk status dan keterangan -->
                            <h5 class="card-title">Persetujuan dan Disposisi Kepala Balai</h5>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="belirum_status" class="form-select" required>
                                        <option value="Pending"
                                            {{ $pengajuan->belirum_status == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Approved"
                                            {{ $pengajuan->belirum_status == 'Approved' ? 'selected' : '' }}>Approved
                                        </option>
                                        <option value="Rejected"
                                            {{ $pengajuan->belirum_status == 'Rejected' ? 'selected' : '' }}>Rejected
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belirum_keterangan" class="form-control"
                                        required>{{ $pengajuan->belirum_keterangan }}</textarea>
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success">Update Pengajuan</button>
                                <a href="{{ route('index.kepala.psapi') }}" class="btn btn-secondary">Kembali</a>
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
            document.getElementById('belisapi_tanggal').setAttribute('min', today);
        });

        @if(session('success'))
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        @endif

    </script>
</main>
