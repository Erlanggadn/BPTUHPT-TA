@include('layouts.utama.main2')
@include('layouts.pembeli.navbar')
@include('layouts.pembeli.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail Pengajuan Pembelian Rumput</h5>
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
                                    <input type="hidden" name="belirum_orang" id="belirum_orang"
                                        value="{{ $pengajuan->belirum_orang }}">
                                    <input type="text" class="form-control"
                                        value="{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_nama : '' }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Asal Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="belirum_instansi" id="belirum_instansi" value="">
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
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian/Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belirum_alasan" id="belirum_alasan" class="form-control"
                                        disabled>{{ $pengajuan->belirum_alasan }}</textarea>
                                </div>
                            </div>

                            <!-- Detail Pengajuan -->
                            <div id="dynamic-field">
                                @foreach ($pengajuan->detailPengajuanRumput as $detail)
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Kategori Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_kategori[]" id="drumput_kategori" class="form-select"
                                            disabled>
                                            <option value="Bibit" {{ $detail->drumput_kategori }}>
                                                {{ $detail->drumput_kategori }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_jenis[]" id="drumput_jenis" class="form-select" disabled>
                                            @foreach($rumputJenis as $jenis)
                                            <option value="{{ $jenis->rum_id }}"
                                                {{ $detail->detail_jenis == $jenis->rum_id ? 'selected' : '' }}>
                                                {{ $jenis->rum_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Berat Rumput (KG)</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="drumput_berat[]" id="drumput_berat"
                                            class="form-control" value="{{ $detail->drumput_berat }}" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Satuan Per</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_satuan[]" id="drumput_satuan" class="form-select"
                                            disabled>
                                            <option value="" {{ $detail->drumput_satuan}}>{{ $detail->drumput_satuan}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <h5 class="card-title">Detail Pembayaran Pembelian Rumput
                            </h5>
                            @if($pembayaran)
                            <!-- Jika detail pembayaran ada, tampilkan -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Invoice</div>
                                <div class="col-lg-9 col-md-8">
                                    <a href="{{ asset('uploads/' . $pembayaran->bayarrum_invoice) }}" target="_blank">
                                        <span class="badge bg-primary">Lihat Invoice</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Ubah Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="dbeli_keterangan" id="dbeli_keterangan" class="form-control"
                                        rows="3" disabled>{{ $pembayaran->bayarrum_keterangan }}</textarea>
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
                        <form action="{{ route('bukti.bayar.rumput', $pembayaran->bayarrum_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Upload Bukti Pembayaran</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="bayarrum_bukti" id="bayarrum_bukti" class="form-control"
                                        accept=".png,.jpg,.jpeg,.pdf" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Ubah Status</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="bayarrum_sudah" id="bayarrum_sudah" class="form-control">
                                        <option value="">{{ $pembayaran->bayarrum_sudah }}</option>
                                        <option value="Saya Sudah Membayar"
                                            {{ $pembayaran->bayarrum_sudah == 'Saya Sudah Membayar' ? 'selected' : '' }}>
                                            Saya Sudah Membayar
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mb-4">Kirim Bukti Pembayaran</button>
                            </div>
                        </form>
                        @else
                        <p class="">*Anda Belum memiliki tagihan pembayaran, Mohon menunggu sampai pengajuan anda
                            disetujui.</p>
                        @endif
                        <div class="text-center">
                            <a href="{{ route('index.pengajuan.rumput') }}" class="btn btn-secondary">Kembali</a>
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
