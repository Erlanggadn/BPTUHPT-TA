@include('layouts.utama.main2')
@include('layouts.admin.main')
@include('layouts.admin.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Hak Akses Akun Pegawai</h5>
                        <p>Berikut ini adalah data hak akses akun yang sepenuhnya dikelola oleh <b>Admin</b> BPTU HPT
                            Padang Mengatas
                        </p>
                        <p>Jumlah Pegawai Saat Ini : <b>{{ $jumlahPegawai }}</b></p>
                        <a class="btn btn-outline-success mb-4" href=""><i class="bi bi-file-earmark-spreadsheet"></i>
                            Cetak Excel</a>
                        <a class="btn btn-outline-danger mb-4" href=""><i class="bi bi-file-earmark-pdf-fill"></i> Cetak
                            PDF</a>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Tgl Buat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($akunuser)
                                    @foreach ($akunuser as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td><a class="btn btn-outline-success"
                                                href="{{ route('detailakun', $item->id) }}"><i
                                                    class="bi bi-info-lg"></i></a>
                                            <form action="{{ route('akunadmin.delete', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')"><i
                                                        class="bi bi-person-x-fill"></i></button>
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
