@include('layouts.utama.main2')
@include('layouts.bendahara.navbar')
@include('layouts.bendahara.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail Pengajuan Pembelian Rumput
                            ({{ $pengajuan->pembeli->pembeli_nama }})
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
                        <!-- Identitas Pembeli -->
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Nama </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="hidden" name="pembeli_id" id="pembeli_id"
                                    value="{{ $pengajuan->pembeli_id }}">
                                <input type="text" class="form-control" value="{{  $pengajuan->pembeli->pembeli_nama }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Asal Instansi</div>
                            <div class="col-lg-9 col-md-8">
                                <input type="hidden" name="pembeli_id" id="pembeli_id" value="">
                                <input type="text" class="form-control"
                                    value="{{  $pengajuan->pembeli->pembeli_instansi }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Nomor HP Perusahaan/Instansi</div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" name="belirum_nohp" id="belirum_nohp" class="form-control"
                                    value="{{ $pengajuan->belirum_nohp }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Alamat Perusahaan/Instansi</div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" name="belirum_alamat" id="belirum_alamat" class="form-control"
                                    value="{{ $pengajuan->belirum_alamat }}" disabled>
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
                                <input type="date" name="belirum_tanggal" id="belirum_tanggal" class="form-control"
                                    value="{{ $pengajuan->belirum_tanggal }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Alasan Pembelian</div>
                            <div class="col-lg-9 col-md-8">
                                <textarea name="belirum_alasan" id="belirum_alasan" class="form-control"
                                    disabled>{{ $pengajuan->belirum_alasan }}</textarea>
                            </div>
                        </div>
                        <h5 class="card-title">Status Pengajuan Pembelian
                        </h5>
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Status Pembelian</div>
                            <div class="col-lg-9 col-md-8">
                                <select name="belirum_status" id="belirum_status" class="form-select" disabled>
                                    <option value="{{ $pengajuan->belirum_status }}" {{ $pengajuan->belirum_status ?
                                        'selected' : '' }}>
                                        {{ $pengajuan->belirum_status }}</option>
                                    <option value="" disabled>-- Status Pembelian --</option>
                                    <option value="Diverifikasi">Diverifikasi</option>
                                    <option value="Tidak verifikasi">Tidak verifikasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Disposisi Kepala Balai</div>
                            <div class="col-lg-9 col-md-8">
                                <textarea name="belirum_keterangan" id="belirum_keterangan" class="form-control"
                                    disabled>{{ $pengajuan->belirum_keterangan }}</textarea>
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
                                    <select name="drumput_jenis[]" id="drumput_jenis" class="form-select" disabled>
                                        @foreach($rumputJenis as $jenis)
                                        <option value="{{ $jenis->rum_id }}" {{ $detail->drumput_jenis == $jenis->rum_id
                                            ? 'selected' : '' }}>
                                            {{ $jenis->rum_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Kategori Rumput</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="drumput_kategori[]" id="drumput_kategori" class="form-select"
                                        disabled>
                                        <option value="B">{{ $detail->drumput_kategori}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Berat Rumput (KG)</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="number" name="drumput_jumlah[]" id="drumput_jumlah"
                                        class="form-control" value="{{ $detail->drumput_berat }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Satuan Per</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="drumput_kelamin[]" id="drumput_kelamin" class="form-select" disabled>
                                        <option>{{ $detail->drumput_satuan}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h5 class="card-title">Detail Pembayaran Pembelian Sapi
                        </h5>
                        <!-- Form untuk input pembayaran -->
                        @if($pembayaran)
                        <!-- Jika detail pembayaran ada, tampilkan -->
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Bukti Bayar</div>
                            <div class="col-lg-9 col-md-8">
                                <a href="{{ asset('uploads/' . $pembayaran->bayarrum_bukti) }}" target="_blank">
                                    <span class="badge bg-success">Bukti Pembayaran</span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Status Bayar Pembeli</div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" name="dbeli_status" id="dbeli_status" class="form-control"
                                    value="{{ $pembayaran->bayarrum_sudah }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 label">Invoice</div>
                            <div class="col-lg-9 col-md-8">
                                <a href="{{ asset('uploads/' . $pembayaran->bayarrum_invoice) }}" target="_blank">
                                    <span class="badge bg-primary">Lihat Invoice</span>
                                </a>
                            </div>
                        </div>
                        <!-- Form untuk mengupdate pembayaran -->
                        <form action="{{ route('update.bayar.prumput', $pembayaran->bayarrum_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status Pembayaran</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="bayarrum_status" id="bayarrum_status" class="form-control">
                                        <option value="" selected disabled>-- Pilih Status --</option>
                                        <option value="Diterima" {{ $pembayaran->dbeli_status == 'Diterima' ? 'selected'
                                            : '' }}>
                                            Diterima</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Ubah Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="bayarrum_keterangan" id="bayarrum_keterangan" class="form-control"
                                        rows="3">{{ $pembayaran->bayarrum_keterangan }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mb-4">Update Pembayaran</button>
                        </form>
                        <div class="mb-4">
                            <a href="{{ route('index.bendahara.prumput') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                        <form action="{{ route('delete.bayar.prumput', $pembayaran->bayarrum_id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Pembayaran</button>
                        </form>
                        @else
                        <!-- Jika detail pembayaran tidak ada, tampilkan form untuk input -->
                        <form action="{{ route('store.bayar.prumput', $pengajuan->belirum_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Invoice</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="bayarrum_invoice" id="bayarrum_invoice"
                                        class="form-control" accept=".png,.jpg,.jpeg,.pdf" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status Pembayaran</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="bayarrum_status" id="bayarrum_status" class="form-select" required>
                                        <option value="" disabled selected>-- Status Pembayaran --</option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Belum diterima">Belum Diterima</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="bayarrum_keterangan" id="bayarrum_keterangan"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success">Simpan Pembayaran</button>
                                <a href="{{ route('index.bendahara.prumput') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>

                        @endif
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<script src="{{ asset ('js/main.js') }}"></script>