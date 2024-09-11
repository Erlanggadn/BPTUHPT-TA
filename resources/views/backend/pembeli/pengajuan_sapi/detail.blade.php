@include('layouts.utama.main2')
@include('layouts.pembeli.navbar')
@include('layouts.pembeli.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail Pengajuan Pembelian Sapi</h5>
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Identitas Pembeli -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama Anda</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="belisapi_orang" id="belisapi_orang"
                                        value="{{ $pengajuan->belisapi_orang }}">
                                    <input type="text" class="form-control"
                                        value="{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_nama : '' }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Asal Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="belisapi_orang" id="belisapi_orang" value="">
                                    <input type="text" class="form-control"
                                        value="{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_instansi : '' }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{ $currentUser->pembeli ? $currentUser->email : '' }}" disabled>
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
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian/Keterangan</div>
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
                                        <select name="sjenis_id[]" id="sjenis_id" class="form-select" disabled>
                                            @foreach($sapiJenis as $jenis)
                                            <option value="{{ $jenis->sjenis_id }}" {{ $detail->sjenis_id ==
                                                $jenis->sjenis_id ? 'selected' : '' }}>
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
                                            @foreach($hargaData as $harga)
                                            <option value="{{ $harga->hs_kategori }}">{{ $harga->hs_kategori
                                                }}</option>
                                            @endforeach
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
                                    <div class="col-lg-3 col-md-4 label">Estimasi Berat Sapi (KG)</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="detail_jumlah[]" id="detail_jumlah"
                                            class="form-control" value="{{ $detail->detail_berat }}" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_kelamin[]" id="detail_kelamin" class="form-select"
                                            disabled>
                                            <option value="Jantan" {{ $detail->detail_kelamin == 'Jantan' ? 'selected' :
                                                '' }}>Jantan
                                            </option>
                                            <option value="Betina" {{ $detail->detail_kelamin == 'Betina' ? 'selected' :
                                                '' }}>Betina
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <h5 class="card-title">Detail Pembayaran Pembelian Sapi
                            </h5>
                            @if($pembayaran)
                            <!-- Jika detail pembayaran ada, tampilkan -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tagihan Pembayaran Anda</div>
                                <div class="col-lg-9 col-md-8">
                                    <a href="{{ asset('uploads/' . $pembayaran->dbeli_invoice) }}" target="_blank">
                                        <span class="badge bg-primary">Lihat Invoice</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="dbeli_keterangan" id="dbeli_keterangan" class="form-control"
                                        rows="3" disabled>{{ $pembayaran->dbeli_keterangan }}</textarea>
                                </div>
                            </div>
                            @else
                            @endif
                            <div class="text-center mb-4">
                                {{-- <a class="btn btn-success" href="{{ route('update.bayar' $belisapi_id) }}">Update
                                    Pengajuan</a> --}}
                            </div>
                        </form>
                        <!-- Form untuk mengupdate pembayaran -->
                        @if($pembayaran)
                        <!-- Form untuk mengupdate pembayaran -->
                        <form action="{{ route('bukti.bayar.pembeli', $pembayaran->dbeli_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Upload Bukti Pembayaran</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="dbeli_bukti" id="dbeli_bukti" class="form-control"
                                        accept=".png,.jpg,.jpeg,.pdf">
                                    @error('dbeli_bukti')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Ubah Status</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="dbeli_sudah" id="dbeli_sudah" class="form-control">
                                        <option value="" disabled selected>-- Pilih Status --</option>
                                        <option value="Saya Sudah Membayar" {{ $pembayaran->dbeli_sudah == 'Saya Sudah
                                            Membayar' ? 'selected' : '' }}>
                                            Saya Sudah Membayar
                                        </option>
                                    </select>
                                    @error('dbeli_sudah')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mb-4">Kirim Bukti Pembayaran</button>
                            </div>
                        </form>
                        @else
                        <div class="text-danger text-center">Data pembayaran tidak ditemukan atau belum diisi.</div>
                        <p class="">*Anda Belum memiliki tagihan pembayaran, Mohon menunggu sampai pengajuan anda
                            disetujui.</p>
                        @endif
                        <div class="text-center">
                            <a href="{{ route('index.pengajuan.sapi') }}" class="btn btn-secondary">Kembali</a>
                        </div>
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