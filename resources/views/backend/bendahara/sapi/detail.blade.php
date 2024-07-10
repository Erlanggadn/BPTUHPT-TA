    @include('layouts.utama.main2')
    @include('layouts.bendahara.navbar')
    @include('layouts.bendahara.sidebar')

    <main id="main" class="main">
        <section class="section profile">
            <div class="justify-content-center">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Detail Pengajuan Pembelian Sapi
                                ({{  $pengajuan->user->pembeli_nama }})
                            </h5>
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                    <input type="hidden" name="belisapi_orang" id="belisapi_orang"
                                        value="{{ $pengajuan->belisapi_orang }}">
                                    <input type="text" class="form-control"
                                        value="{{  $pengajuan->user->pembeli_nama }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Asal Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="belisapi_orang" id="belisapi_orang" value="">
                                    <input type="text" class="form-control"
                                        value="{{  $pengajuan->user->pembeli_instansi }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nomor HP Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="belisapi_nohp" id="belisapi_nohp" class="form-control"
                                        value="{{ $pengajuan->belisapi_nohp }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alamat Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="belisapi_alamat" id="belisapi_alamat" class="form-control"
                                        value="{{ $pengajuan->belisapi_alamat }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Surat Pengajuan</div>
                                <div class="col-lg-9 col-md-8 ">
                                    <a class="mb-4" href="{{ asset('uploads/' . $pengajuan->belisapi_surat) }}"
                                        target="_blank"><span class="badge bg-primary">Lihat Surat</span></a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="belisapi_tanggal" id="belisapi_tanggal"
                                        class="form-control" value="{{ $pengajuan->belisapi_tanggal }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belisapi_alasan" id="belisapi_alasan" class="form-control"
                                        disabled>{{ $pengajuan->belisapi_alasan }}</textarea>
                                </div>
                            </div>
                            <h5 class="card-title">Status Pengajuan Pembelian
                            </h5>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="belisapi_status" id="belisapi_status" class="form-select" disabled>
                                        <option value="{{ $pengajuan->belisapi_status }}"
                                            {{ $pengajuan->belisapi_status ? 'selected' : '' }}>
                                            {{ $pengajuan->belisapi_status }}</option>
                                        <option value="" disabled>-- Status Pembelian --</option>
                                        <option value="Diverifikasi">Diverifikasi</option>
                                        <option value="Tidak verifikasi">Tidak verifikasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Disposisi Kepala Balai</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belisapi_keterangan" id="belisapi_keterangan" class="form-control"
                                        disabled>{{ $pengajuan->belisapi_keterangan }}</textarea>
                                </div>
                            </div>
                            <h5 class="card-title">Pengajuan Produk
                            </h5>
                            <!-- Detail Pengajuan -->
                            <div id="dynamic-field">
                                @foreach ($pengajuan->details as $detail)
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_jenis[]" id="detail_jenis" class="form-select" disabled>
                                            @foreach($sapiJenis as $jenis)
                                            <option value="{{ $jenis->sjenis_id }}"
                                                {{ $detail->detail_jenis == $jenis->sjenis_id ? 'selected' : '' }}>
                                                {{ $jenis->sjenis_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Kategori Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_kategori[]" id="detail_kategori" class="form-select"
                                            disabled>
                                            <option value="Bibit"
                                                {{ $detail->detail_kategori == 'Bibit' ? 'selected' : '' }}>Bibit
                                            </option>
                                            <optgroup label="Bibit">
                                                <option value="Bibit  6-9 Bulan"
                                                    {{ $detail->detail_kategori == 'Bibit  6-9 Bulan' ? 'selected' : '' }}>
                                                    Bibit 6-9 Bulan</option>
                                                <option value="Bibit 9-12 Bulan"
                                                    {{ $detail->detail_kategori == 'Bibit 9-12 Bulan' ? 'selected' : '' }}>
                                                    Bibit 9-12 Bulan</option>
                                                <option value="Bibit 12-15 Bulan"
                                                    {{ $detail->detail_kategori == 'Bibit 12-15 Bulan' ? 'selected' : '' }}>
                                                    Bibit 12-15 Bulan</option>
                                                <option value="Bibit 15-18 Bulan"
                                                    {{ $detail->detail_kategori == 'Bibit 15-18 Bulan' ? 'selected' : '' }}>
                                                    Bibit 15-18 Bulan</option>
                                                <option value="Bibit 18-24 Bulan"
                                                    {{ $detail->detail_kategori == 'Bibit 18-24 Bulan' ? 'selected' : '' }}>
                                                    Bibit 18-24 Bulan</option>
                                                <option value="Bibit 24-36 Bulan"
                                                    {{ $detail->detail_kategori == 'Bibit 24-36 Bulan' ? 'selected' : '' }}>
                                                    Bibit 24-36 Bulan</option>
                                            </optgroup>
                                            <optgroup label="Calon Bul(Pejantan)">
                                                <option value="Calon Bul(Pejantan) 18-24 Bulan"
                                                    {{ $detail->detail_kategori == 'Calon Bul(Pejantan) 18-24 Bulan' ? 'selected' : '' }}
                                                    disabled>
                                                    18-24 Bulan</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jumlah Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="detail_jumlah[]" id="detail_jumlah"
                                            class="form-control" value="{{ $detail->detail_jumlah }}" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_kelamin[]" id="detail_kelamin" class="form-select"
                                            disabled>
                                            <option value="Jantan"
                                                {{ $detail->detail_kelamin == 'Jantan' ? 'selected' : '' }}>Jantan
                                            </option>
                                            <option value="Betina"
                                                {{ $detail->detail_kelamin == 'Betina' ? 'selected' : '' }}>Betina
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
                                    <a href="{{ asset('uploads/' . $pembayaran->dbeli_bukti) }}" target="_blank">
                                        <span class="badge bg-success">Bukti Pembayaran</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status Bayar Pembeli</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="dbeli_status" id="dbeli_status" class="form-control"
                                        value="{{ $pembayaran->dbeli_sudah }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Invoice</div>
                                <div class="col-lg-9 col-md-8">
                                    <a href="{{ asset('uploads/' . $pembayaran->dbeli_invoice) }}" target="_blank">
                                        <span class="badge bg-primary">Lihat Invoice</span>
                                    </a>
                                </div>
                            </div>
                            <!-- Form untuk mengupdate pembayaran -->
                            <form action="{{ route('update.bayar.psapi', $pembayaran->dbeli_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Status Pembayaran</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="dbeli_status" id="dbeli_status" class="form-control">
                                            <option value="">{{ $pembayaran->dbeli_status }}</option>
                                            <option value="Diterima"
                                                {{ $pembayaran->dbeli_status == 'Diterima' ? 'selected' : '' }}>
                                                Diterima</option>
                                            <option value="Belum Diterima"
                                                {{ $pembayaran->dbeli_status == 'Belum Diterima' ? 'selected' : '' }}>
                                                Belum Diterima</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Ubah Keterangan</div>
                                    <div class="col-lg-9 col-md-8">
                                        <textarea name="dbeli_keterangan" id="dbeli_keterangan" class="form-control"
                                            rows="3">{{ $pembayaran->dbeli_keterangan }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mb-4">Update Pembayaran</button>
                            </form>
                            <form action="{{ route('delete.bayar.psapi', $pembayaran->dbeli_id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Pembayaran</button>
                            </form>
                            @else
                            <!-- Jika detail pembayaran tidak ada, tampilkan form untuk input -->
                            <form action="{{ route('store.bayar.psapi', $pengajuan->belisapi_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Invoice</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="file" name="dbeli_invoice" id="dbeli_invoice" class="form-control"
                                            accept=".png,.jpg,.jpeg,.pdf" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Status Pembayaran</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="dbeli_status" id="dbeli_status" class="form-select" required>
                                            <option value="" disabled selected>-- Status Pembayaran --</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Belum diterima">Belum Diterima</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" name="dbeli_keterangan" id="dbeli_keterangan"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-success">Simpan Pembayaran</button>
                                    <a href="{{ route('index.bendahara.psapi') }}" class="btn btn-secondary">Kembali</a>
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
