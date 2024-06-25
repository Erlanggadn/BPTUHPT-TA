@extends('layouts.utama.main2')
@extends('layouts.wasbitnak.navbar')
@extends('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kegiatan Kandang</h5>
                        <p>Berikut ini adalah data Kegiatan Kandang yang sepenuhnya dikelola oleh <b>Divisi Pengawas
                                Bibit Ternak</b> BPTU HPT Padang Mengatas</p>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <a href="{{ route('show.kegiatan.kandang') }}" class="btn btn-primary "><i
                                class="bi bi-plus"></i> Tambah Kegiatan </a>
                        <a href="{{ route('export.kegiatan.kandang', request()->query()) }}" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Export to
                            Excel</a>
                    </div>


                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>ID/Kode Kegiatan</th>
                                <th>Kode Kandang</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($Kegiatan)
                            @foreach ($Kegiatan as $item)
                            <tr>
                                <td>{{ $item->kegiatan_id }}</td>
                                <td>{{ $item->kegiatan_jenis_kandang }} - [
                                    {{ $item->kandang->jenisKandang->kandang_tipe }}
                                    - {{ $item->kandang->kand_nama }} ]</td>
                                <td>{{ $item->kegiatan_tanggal }}</td>
                                <td>{{ $item->kegiatan_keterangan }}</td>
                                <td>
                                    @if ($item->kegiatan_status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                    @elseif ($item->kegiatan_status == 'Proses')
                                    <span class="badge bg-warning">Proses</span>
                                    @else
                                    <span class="badge bg-danger">Belum Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-outline-success"
                                        href="{{ route('detail.kegiatan.kandang', $item->kegiatan_id) }}"><i
                                            class="bi bi-info-lg"></i></a>
                                    <form id="deleteForm"
                                        action="{{ route('destroy.kegiatan.kandang', $item->kegiatan_id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger"
                                            onclick="showDeleteModal('{{ route('destroy.kegiatan.kandang', $item->kegiatan_id) }}')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Modal Template -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data Kandang ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Template Main JS File -->
<script src="{{ asset('js/main.js') }}"></script>
<script>
    function showDeleteModal(action) {
        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = action;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    document.getElementById('confirmDelete').addEventListener('click', function () {
        document.getElementById('deleteForm').submit();
    });

</script>