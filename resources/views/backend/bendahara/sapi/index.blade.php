@php
use Carbon\Carbon;
@endphp
@include('layouts.utama.main2')
@include('layouts.bendahara.navbar')
@include('layouts.bendahara.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pengajuan Sapi</h5>
                        <p>Berikut ini adalah data Pengajuan Sapi yang sepenuhnya dikelola oleh <b>Divisi PPID</b> BPTU
                            HPT Padang Mengatas
                        </p>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID Pengajuan</th>
                                        <th>Nama Pengirim</th>
                                        <th>Asal Instansi</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($PSapi)
                                    @foreach ($PSapi as $item)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $item->belisapi_id}}</span></td>
                                        <td>{{ $item->user->pembeli_nama }}</td>
                                        <td>{{ $item->user->pembeli_instansi }}</td>
                                        <td>{{ Carbon::parse($item->belisapi_tanggal)->translatedFormat('j F Y') }}</td>
                                        <td>{{ $item->belisapi_keterangan }}</td>
                                        <td>{{ $item->belisapi_status}}</td>
                                        <td> <a class="btn btn-outline-success"
                                                href="{{ route('detail.bendahara.psapi', $item->belisapi_id) }}"><i
                                                    class="bi bi-info-lg"></i></a>
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
    <!-- Modal Template -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data Pengajuan Pembelian Sapi ini?</p>
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
<script src="{{ asset ('js/main.js') }}"></script>
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
