@include('layouts.utama.main2')
@include('layouts.admin.main')
@include('layouts.admin.sidebar')

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Hak Akses Akun Pegawai</h5>
                        <p>Berikut ini adalah data hak akses akun yang sepenuhnya dikelola oleh <b>Admin</b> BPTU HPT
                            Padang Mengatas</p>
                        <form method="GET" action="{{ route('akunadmin') }}" class="row mb-4">
                            <div class="col-md-2">
                                <label for="start_date" class="form-label">Tanggal Buat Awal</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ $startDate ?? '' }}">
                            </div>
                            <div class="col-md-2">
                                <label for="end_date" class="form-label">Tanggal Buat Akhir</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ $endDate ?? '' }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary form-control"><i class="bi bi-funnel"></i>
                                    Filter</button>
                            </div>
                        </form>
                        <a href="{{ route('pegawai.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-success mb-4">
                            <i class="bi bi-file-earmark-excel"></i> Export ke Excel
                        </a>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>No Hp</th>
                                        <th>Jabatan</th>
                                        <th>Tgl Buat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($pegawai)
                                    @foreach ($pegawai as $item)
                                    <tr>
                                        <td>{{ $item->pegawai_id }}</td>
                                        <td>{{ $item->pegawai_nama }}</td>
                                        <td>{{ $item->pegawai_nohp }}</td>
                                        <td>{{ $item->user->role }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td><a class="btn btn-outline-success"
                                                href="{{ route('detailakun', $item->user_id) }}"><i
                                                    class="bi bi-info-lg"></i></a>
                                            <form action="{{ route('akunadmin.delete', $item->user_id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-action="{{ route('akunadmin.delete', $item->user_id) }}">
                                                    <i class="bi bi-person-x-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Selamat Datang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda telah berhasil login.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Daftar Pegawai -->
<div class="modal fade" id="successModalPegawai" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Pendaftaran Akun Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Akun telah didaftarkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Hapus Pegawai dan Pembeli -->
<div class="modal fade" id="successModalhapusakun" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Akun telah dihapus
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal HAPUS akun -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus akun ini?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<!-- Template Main JS File -->
<script src="{{ asset ('js/main.js') }}"></script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });

</script>
@endif
@if(session('berhasil.pegawai'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successModal = new bootstrap.Modal(document.getElementById('successModalPegawai'));
        successModal.show();
    });

</script>
@endif
@if(session('berhasil.hapus'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successModal = new bootstrap.Modal(document.getElementById('successModalhapusakun'));
        successModal.show();
    });

</script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Tombol yang mengaktifkan modal
            var actionUrl = button.getAttribute('data-action'); // Ambil URL dari atribut data-action

            var form = deleteModal.querySelector('#deleteForm');
            form.setAttribute('action', actionUrl);
        });
    });

</script>
