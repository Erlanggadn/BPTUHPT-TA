@include('layouts.utama.main2')
@include('layouts.pembeli.navbar')
@include('layouts.pembeli.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Form Pengajuan Pembelian Sapi</h5>
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
                        <form action="{{ route('store.pengajuan.sapi') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Identitas Pembeli -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama Anda</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="belisapi_orang" id="belisapi_orang"
                                        value="{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_id : $currentUser->name }}">
                                    <input type="text" class="form-control"
                                        value="{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_nama : '' }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="" id="" value="">
                                    <input type="text" class="form-control" value="{{ $currentUser->email }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nomor HP Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="number" name="belisapi_nohp" id="belisapi_nohp" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alamat Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="belisapi_alamat" id="belisapi_alamat" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Surat Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="belisapi_surat" id="belisapi_surat" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="belisapi_tanggal" id="belisapi_tanggal"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belisapi_alasan" id="belisapi_alasan" class="form-control"
                                        required></textarea>
                                </div>
                            </div>

                            <!-- Detail Pengajuan -->
                            <div id="dynamic-field">
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_jenis[]" id="detail_jenis" class="form-select" required>
                                            @foreach($sapiJenis as $jenis)
                                            <option value="{{ $jenis->sjenis_id }}">{{ $jenis->sjenis_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Kategori Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_kategori[]" id="detail_kategori" class="form-select"
                                            required>
                                            <option value="Bibit">Bibit</option>
                                            <optgroup label="Bibit">
                                                <option value="Bibit  6-9 Bulan">Bibit 6-9 Bulan</option>
                                                <option value="Bibit 9-12 Bulan">Bibit 9-12 Bulan</option>
                                                <option value="Bibit 12-15 Bulan">Bibit 12-15 Bulan</option>
                                                <option value="Bibit 15-18 Bulan">Bibit 15-18 Bulan</option>
                                                <option value="Bibit 18-24 Bulan">Bibit 18-24 Bulan</option>
                                                <option value="Bibit 24-36 Bulan">Bibit 24-36 Bulan</option>
                                            </optgroup>
                                            <optgroup label="Calon Bul(Pejantan)">
                                                <option value="Calon Bul(Pejantan) 18-24 Bulan">18-24 Bulan</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jumlah Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="detail_jumlah[]" id="detail_jumlah"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_kelamin[]" id="detail_kelamin" class="form-select"
                                            required>
                                            <option value="Jantan">Jantan</option>
                                            <option value="Betina">Betina</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="badge bg-danger">*jika membeli lebih dari satu jenis</p>
                            <div class=" mb-4">
                                <button type="button" class="btn btn-primary" id="add-field">Tambah Jenis
                                    Sapi</button>

                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success">Ajukan Pembelian</button>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Terima kasih telah melakukan pengajuan, silahkan tunggu konfirmasi dari PPID.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Maaf pengajuan gagal/ anda sudah melakukan pengajuan sebelumnya.
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        @endif

        @if(session('error'))
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
        @endif
    });

</script>
