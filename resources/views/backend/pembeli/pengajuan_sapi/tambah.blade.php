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
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif


                        <form action="{{ route('store.pengajuan.sapi') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" name="" id="" value="">
                                    <input type="text" class="form-control" value="{{ $currentUser->email }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nomor HP Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="number" name="belisapi_nohp" id="belisapi_nohp" class="form-control">
                                </div>
                                @error('belisapi_nohp')
                                <div class="invalid-feedback" style="display: block;">
                                    No HP tidak valid/kosong
                                    <!-- Pesan error yang diubah secara manual -->
                                </div>
                                @enderror
                            </div>


                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alamat Perusahaan/Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="belisapi_alamat" id="belisapi_alamat" class="form-control">
                                </div>
                                @error('belisapi_alamat')
                                <div class="invalid-feedback" style="display: block;">
                                    Alamat Perusahaan tidak valid/kosong
                                    <!-- Pesan error yang diubah secara manual -->
                                </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Surat Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="file" name="belisapi_surat" id="belisapi_surat" class="form-control">
                                </div>
                                @error('belisapi_surat')
                                <div class="invalid-feedback" style="display: block;">
                                    Ukuran file terlalu besar atau kolom masih kosong
                                    <!-- Pesan error yang diubah secara manual -->
                                </div>
                                @enderror
                            </div>


                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Pengajuan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="belisapi_tanggal" id="belisapi_tanggal"
                                        class="form-control">
                                </div>
                                @error('belisapi_tanggal')
                                <div class="invalid-feedback" style="display: block;">
                                    Tanggal pengajuan diisi
                                    <!-- Pesan error yang diubah secara manual -->
                                </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alasan Pembelian</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="belisapi_alasan" id="belisapi_alasan"
                                        class="form-control"></textarea>
                                </div>
                                @error('belisapi_alasan')
                                <div class="invalid-feedback" style="display: block;">
                                    Alasan pembelian harus diisi
                                    <!-- Pesan error yang diubah secara manual -->
                                </div>
                                @enderror
                            </div>

                            <!-- Detail Pengajuan -->
                            <div id="dynamic-group">
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="sjenis_id[]" id="sjenis_id" class="form-select">
                                            <option value="" selected disabled>-- Jenis Sapi --</option>
                                            @foreach($sapiJenis as $jenis)
                                            <option value="{{ $jenis->sjenis_id }}">{{ $jenis->sjenis_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_kelamin[]" id="detail_kelamin" class="form-select"
                                            disabled>
                                            <option value="" selected disabled>-- Jenis Kelamin --</option>
                                            <option value="Jantan">Jantan</option>
                                            <option value="Betina">Betina</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Kategori Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <select name="detail_kategori[]" id="detail_kategori" class="form-select"
                                            disabled>
                                            <option selected disabled>-- Kategori --</option>
                                            @foreach($hargaData as $harga)
                                            <option value="{{ $harga->hs_kategori }}"
                                                data-sjenis="{{ $harga->sjenis_id }}"
                                                data-kelamin="{{ $harga->hs_kelamin }}">{{ $harga->hs_kategori }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Estimasi Berat Sapi (KG)</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="detail_berat[]" id="detail_berat"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 label">Jumlah Sapi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" name="detail_jumlah[]" id="detail_jumlah"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>
                            <p class="badge bg-danger">*jika membeli lebih dari satu jenis</p>
                            <div class=" mb-4">
                                <button type="button" class="btn btn-primary" id="add-field">Tambah Jenis
                                    Sapi</button>

                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Total Harga Sementara</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" id="total_harga" class="form-control" readonly>
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
                    Maaf pengajuan gagal/ anda sudah melakukan pengajuan sebelumnya.
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

        // Disable Kategori dan Jenis Kelamin pada form baru dan reset value
        var clonedJenis = clone.querySelector('#sjenis_id-' + fieldCounter);
        var clonedKelamin = clone.querySelector('#detail_kelamin-' + fieldCounter);
        var clonedKategori = clone.querySelector('#detail_kategori-' + fieldCounter);
        
        clonedKelamin.disabled = true;
        clonedKategori.disabled = true;

        // Add event listener untuk dropdown dinamis pada clone
        clonedJenis.addEventListener('change', function() {
            var selectedJenis = clonedJenis.value;
            clonedKelamin.disabled = false;
            clonedKategori.disabled = true;
            clonedKategori.value = '';  // Reset kategori value
        });

        clonedKelamin.addEventListener('change', function() {
            var selectedJenis = clonedJenis.value;
            var selectedKelamin = clonedKelamin.value;

            clonedKategori.disabled = false;
            clonedKategori.value = '';  // Reset kategori value

            // Filter kategori berdasarkan jenis dan kelamin
            clonedKategori.querySelectorAll('option').forEach(function(option) {
                if (option.dataset.sjenis == selectedJenis && option.dataset.kelamin == selectedKelamin) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            });
        });
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
        var dynamicField = document.querySelector('dynamic-group'); // Group field yang akan di-clone
        var addFieldButton = document.getElementById('add-field');

        addFieldButton.addEventListener('click', function () {
            // Clone hanya elemen dynamic-group, bukan seluruh form
            var clone = dynamicField.cloneNode(true);

            // Bersihkan input dalam clone
            var inputs = clone.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.value = ''; // Kosongkan nilai
                input.name = input.name.replace(/\[\d+\]/, '[' + document.querySelectorAll('dynamic-group').length + ']'); // Update index nama field
            });

            // Tambahkan field clone sebelum tombol "Tambah Jenis Sapi"
            addFieldButton.parentElement.before(clone);

            // Pasang ulang listeners setelah field baru ditambahkan
            recalculateListeners();

            // Hitung ulang total setelah field baru ditambahkan
            calculateTotal();
        });

        function recalculateListeners() {
            document.querySelectorAll('select[name^="sjenis_id"], select[name^="detail_kategori"], input[name^="detail_jumlah"], select[name^="detail_kelamin"]').forEach(element => {
                element.removeEventListener('change', calculateTotal); // Hapus listener lama
                element.addEventListener('change', calculateTotal); // Tambahkan listener baru
            });
        }

        function calculateTotal() {
            let total = 0;
            const jenisSapi = document.querySelectorAll('select[name^="sjenis_id"]');
            const kategoriSapi = document.querySelectorAll('select[name^="detail_kategori"]');
            const jumlahSapi = document.querySelectorAll('input[name^="detail_jumlah"]');
            const kelaminSapi = document.querySelectorAll('select[name^="detail_kelamin"]');

            jenisSapi.forEach((_, index) => {
                const jenisId = jenisSapi[index].value;
                const kategori = kategoriSapi[index].value;
                const jumlah = jumlahSapi[index].value;
                const kelamin = kelaminSapi[index].value;

                // Pastikan semua field sudah diisi sebelum menghitung harga
                if (jenisId && kategori && jumlah && kelamin) {
                    // Ambil harga berdasarkan jenis, kategori, dan kelamin
                    const hargaPerEkor = getHarga(jenisId, kategori, kelamin);
                    total += hargaPerEkor * jumlah;
                }
            });

            // Update total harga ke field
            document.getElementById('total_harga').value = `Rp. ${total.toLocaleString('id-ID')}`;
        }

        function getHarga(jenisId, kategori, kelamin) {
            const hargaData = @json($hargaData); // Pastikan hargaData di-passing dari backend

            // Cari harga yang sesuai dengan jenis, kategori, dan kelamin
            const harga = hargaData.find(item => 
                item.sjenis_id == jenisId && 
                item.hs_kategori == kategori && 
                item.hs_kelamin == kelamin
            );

            return harga ? harga.hs_harga : 0; // Kembalikan harga jika ditemukan, jika tidak, kembalikan 0
        }

        // Pasang listeners pada saat halaman pertama kali dimuat
        recalculateListeners();

        // Hitung total ketika halaman pertama kali dimuat
        calculateTotal();
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
    document.getElementById('sjenis_id').addEventListener('change', function() {
        const sjenisId = this.value;

        // Enable and filter the 'Jenis Kelamin' dropdown
        const kelaminSelect = document.getElementById('detail_kelamin');
        kelaminSelect.disabled = false;

        // Add event listener to 'Jenis Kelamin'
        kelaminSelect.addEventListener('change', function() {
            const kelaminValue = this.value;

            // Enable and filter the 'Kategori Sapi' dropdown
            const kategoriSelect = document.getElementById('detail_kategori');
            kategoriSelect.disabled = false;

            // Filter the options in the 'Kategori Sapi' dropdown
            Array.from(kategoriSelect.options).forEach(function(option) {
                // Show only options that match both selected 'Jenis Sapi' and 'Jenis Kelamin'
                if (option.getAttribute('data-sjenis') === sjenisId && option.getAttribute('data-kelamin') === kelaminValue) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    });
</script>