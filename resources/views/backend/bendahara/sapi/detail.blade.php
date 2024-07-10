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
                            @if($pembayaran)
                            <!-- If payment details exist, show them -->

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Invoice</div>
                                <div class="col-lg-9 col-md-8">
                                    <a href="{{ asset('uploads/' . $pembayaran->dbeli_invoice) }}" target="_blank"><span
                                            class="badge bg-primary">Lihat
                                            Invoice</span></a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status Pembayaran</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="dbeli_status" id="dbeli_status" class="form-control"
                                        value="{{ $pembayaran->dbeli_status }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="dbeli_keterangan" id="dbeli_keterangan"
                                        class="form-control" value="{{ $pembayaran->dbeli_keterangan }}" disabled>
                                </div>
                            </div>
                            @else
                            <!-- Pembayaran Sapi -->
                            <<form action="{{ route('store.bayar.sapi', $detail->detail_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Identitas Pembeli dan Detail Pengajuan -->

                                <!-- Pembayaran Sapi -->

                                <h5 class="card-title">Detail Pembayaran</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Status Pembayaran</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" name="dbeli_sudah" id="dbeli_sudah" class="form-control"
                                            value="{{ old('dbeli_sudah', $pembayaran->dbeli_sudah ?? '') }}" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Invoice</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if(isset($pembayaran) && $pembayaran->dbeli_invoice)
                                        <a href="{{ Storage::url($pembayaran->dbeli_invoice) }}" target="_blank">Lihat
                                            Invoice</a>
                                        @else
                                        <input type="file" name="dbeli_invoice" id="dbeli_invoice" class="form-control"
                                            accept=".png,.jpg,.jpeg,.pdf" required>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Status Pembayaran</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="dbeli_status" id="dbeli_status" class="form-select" required>
                                            <option value="" disabled
                                                {{ old('dbeli_status', $pembayaran->dbeli_status ?? '') == '' ? 'selected' : '' }}>
                                                -- Status Pembayaran --</option>
                                            <option value="diterima"
                                                {{ old('dbeli_status', $pembayaran->dbeli_status ?? '') == 'diterima' ? 'selected' : '' }}>
                                                Diterima</option>
                                            <option value="Belum diterima"
                                                {{ old('dbeli_status', $pembayaran->dbeli_status ?? '') == 'Belum diterima' ? 'selected' : '' }}>
                                                Belum Diterima</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" name="dbeli_keterangan" id="dbeli_keterangan"
                                            class="form-control"
                                            value="{{ old('dbeli_keterangan', $pembayaran->dbeli_keterangan ?? '') }}">
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
