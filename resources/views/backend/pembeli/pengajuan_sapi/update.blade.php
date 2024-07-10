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
                        <form action="{{ route('update.bayar.pembeli') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <!-- Identitas Pembeli (existing fields) -->
                        
                            <!-- Tambahkan di sini dua input field baru -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Bukti Pembayaran</div>
                                <div class="col-lg-9 col-md-8">
                                    @if(isset($pembayaran) && $pembayaran->dbeli_bukti)
                                        <a href="{{ asset('uploads/' . $pembayaran->dbeli_bukti) }}" target="_blank">Lihat Bukti</a>
                                    @else
                                        <input type="file" name="dbeli_bukti" id="dbeli_bukti" class="form-control" accept=".png,.jpg,.jpeg,.pdf">
                                    @endif
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan Pembayaran</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="dbeli_keterangan" id="dbeli_keterangan" class="form-control">{{ $pembayaran->dbeli_keterangan ?? '' }}</textarea>
                                </div>
                            </div>
                        
                            <!-- Detail Pengajuan (existing fields) -->
                        
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success">Update Pengajuan</button>
                                <a href="{{ route('index.pengajuan.sapi') }}" class="btn btn-secondary">Kembali</a>
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
