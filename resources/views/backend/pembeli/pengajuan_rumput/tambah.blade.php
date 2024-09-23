@include('layouts.utama.main2')
@include('layouts.pembeli.navbar')
@include('layouts.pembeli.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Form Pengajuan Pembelian Rumput</h5>
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
                        <form action="{{ route('store.pengajuan.rumput') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Identitas Pembeli -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama Anda</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="pembeli_id" id="pembeli_id"
                                        value="{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_id : $currentUser->name }}">
                                    <input type="text" class="form-control"
                                        value="{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_nama : '' }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Email Anda</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="" id="" value="">
                                    <input type="text" class="form-control" value="{{ $currentUser->email }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nomor HP Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="number" name="belirum_nohp" id="belirum_nohp" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alamat Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="belirum_alamat" id="belirum_alamat" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Surat Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="belirum_surat" id="belirum_surat" class="form-control">
                                </div>
                                @error('belirum_surat')
                                <div class="invalid-feedback" style="display: block;">
                                    Ukuran file terlalu besar atau kolom masih kosong
                                    <!-- Pesan error yang diubah secara manual -->
                                </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="belirum_tanggal" id="belirum_tanggal" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belirum_alasan" id="belirum_alasan" class="form-control"
                                        required></textarea>
                                </div>
                            </div>

                            <!-- Detail Pengajuan -->
                            <h5 class="card-title">Form Jenis Produk</h5>
                            <div id="dynamic-field">
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="rum_id[]" id="rum_id" class="form-select" required>
                                            <option value="" selected disabled>-- Pilih Jenis --</option>
                                            @foreach($rumputJenis as $jenis)
                                            <option value="{{ $jenis->rum_id }}">{{ $jenis->rum_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Kategori Rumput</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_kategori[]" id="drumput_kategori" class="form-select"
                                            required>
                                            <option value="" selected disabled>-- Pilih Kategori --</option>
                                            @foreach($hargaRumput as $harga)
                                            <option value="{{ $harga->hr_kategori }}">{{ $harga->hr_kategori }} - {{
                                                $harga->hr_satuan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Satuan Per</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="drumput_satuan[]" id="drumput_satuan" class="form-select"
                                            required>
                                            <option value="" selected disabled>-- Pilih Satuan --</option>
                                            @foreach($hargaRumput as $harga)
                                            <option value="{{ $harga->hr_satuan }}">{{ $harga->hr_satuan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jumlah Pembelian</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="drumput_berat[]" id="drumput_berat"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <p class="badge bg-danger">*jika membeli lebih dari satu jenis</p>
                            <div class=" mb-4">
                                <button type="button" class="btn btn-primary" id="add-field">Tambah Jenis
                                    Rumput</button>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Total Harga Sementara (Rp)</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" id="totalHargaRumput" class="form-control" value="0" readonly>
                                </div>
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
                    Maaf pengajuan gagal, anda sudah melakukan pengajuan sebelumnya.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal verifikasi pengajuan -->
    <div class="modal fade" id="existingRequestModal" tabindex="-1" aria-labelledby="existingRequestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existingRequestModalLabel">Pengajuan Tertunda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Maaf, Anda sudah memiliki pengajuan yang belum diverifikasi. Harap tunggu hingga pengajuan
                    sebelumnya diproses.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // var dynamicField = document.getElementById('dynamic-field');
    var addFieldButton = document.getElementById('add-field');
    var totalHargaInput = document.getElementById('totalHargaRumput');
    var hargaRumput = @json($hargaRumput); // Ambil harga dari server-side

    function updateTotalHarga() {
        var totalHarga = 0;
        var beratInputs = document.querySelectorAll('input[name="drumput_berat[]"]');
        var rumputSelects = document.querySelectorAll('select[name="rum_id[]"]');
        
        beratInputs.forEach(function(input, index) {
            var berat = parseFloat(input.value) || 0;
            var rumputId = rumputSelects[index].value;
            
            // Cari harga berdasarkan rumput yang dipilih
            var hargaPerKg = hargaRumput.find(h => h.rum_id == rumputId)?.hr_harga || 0;
            totalHarga += berat * hargaPerKg;
        });
        totalHargaInput.value = totalHarga.toLocaleString();
    }

    // Fungsi untuk menambahkan event listener ke field baru
    function addEventListenersToFields() {
        var beratInputs = document.querySelectorAll('input[name="drumput_berat[]"]');
        var rumputSelects = document.querySelectorAll('select[name="rum_id[]"]');
        
        beratInputs.forEach(function(input) {
            input.removeEventListener('input', updateTotalHarga); // Pastikan tidak ada event listener ganda
            input.addEventListener('input', updateTotalHarga);
        });
        
        rumputSelects.forEach(function(select) {
            select.removeEventListener('change', updateTotalHarga); // Pastikan tidak ada event listener ganda
            select.addEventListener('change', updateTotalHarga);
        });
    }

    // Panggil fungsi ini sekali di awal untuk field yang ada
    addEventListenersToFields();

    // Ketika tombol "Tambah Jenis Rumput" diklik, tambahkan field baru
    addFieldButton.addEventListener('click', function () {
        var clone = dynamicField.cloneNode(true);
        document.querySelector('form').insertBefore(clone, addFieldButton.parentElement);
        
        // Setelah field baru ditambahkan, pasang kembali event listener ke semua input dan select
        addEventListenersToFields();
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if($existingPengajuan)
        var existingRequestModal = new bootstrap.Modal(document.getElementById('existingRequestModal'));
        existingRequestModal.show();
        @endif
    });
</script>
<script>
    var existingRequestModal = document.getElementById('existingRequestModal');
    
    // Ketika modal ditutup, alihkan ke halaman home
    existingRequestModal.addEventListener('hide.bs.modal', function () {
        window.location.href = "{{ url('/') }}"; // arahkan ke halaman home
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var dynamicField = document.getElementById('dynamic-group');
    var addFieldButton = document.getElementById('add-field');
    var fieldCounter = 1;

    addFieldButton.addEventListener('click', function () {
        var clone = dynamicField.cloneNode(true);
        fieldCounter++;

        // Update ID dan Name pada cloned elements agar unik
        clone.querySelectorAll('select, input').forEach(function (element) {
            var originalId = element.id;
            element.id = originalId + '-' + fieldCounter;
            element.name = element.name.replace('[]', '[' + fieldCounter + ']');
        });

        // Insert cloned form before the add button
        document.querySelector('form').insertBefore(clone, addFieldButton.parentElement);

        // Disable Kategori dan Satuan pada form baru dan reset value
        var clonedJenis = clone.querySelector('#rum_id-' + fieldCounter);
        var clonedKategori = clone.querySelector('#drumput_kategori-' + fieldCounter);
        var clonedSatuan = clone.querySelector('#drumput_satuan-' + fieldCounter);
        
        clonedKategori.disabled = true;
        clonedSatuan.disabled = true;

        // Add event listener untuk dropdown dinamis pada clone
        clonedJenis.addEventListener('change', function() {
            var selectedJenis = clonedJenis.value;
            clonedKategori.disabled = false;
            clonedSatuan.disabled = true;
            clonedKategori.value = '';  // Reset kategori value
        });

        clonedKategori.addEventListener('change', function() {
            var selectedKategori = clonedKategori.value;

            clonedSatuan.disabled = false;
            clonedSatuan.value = '';  // Reset satuan value

            // Filter satuan berdasarkan kategori
            clonedSatuan.querySelectorAll('option').forEach(function(option) {
                if (option.dataset.kategori == selectedKategori) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    });
});

</script>