@php
use Carbon\Carbon;
@endphp
@include('layouts.utama.main2')
@include('layouts.ppid.navbar')
@include('layouts.ppid.sidebar')

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pengajuan Sapi</h5>
                        @if($jumlahSedangDiproses > 0)
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Jumlah data yang sedang diproses: <span class="badge bg-danger">{{ $jumlahSedangDiproses
                                }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <p>Berikut ini adalah data Pengajuan Sapi yang sepenuhnya dikelola oleh <b>Divisi PPID</b> BPTU
                            HPT Padang Mengatas
                        </p>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form method="GET" action="{{ route('filter.ppid.psapi') }}" class="row g-3 my-3">
                            <div class="col-md-5">
                                <label for="tanggal_mulai" class="form-label">Mulai Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                            </div>
                            <div class="col-md-5">
                                <label for="tanggal_selesai" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel"></i>
                                    Filter</button>
                            </div>
                        </form>
                        <a href="{{ route('index.ppid.psapi') }}" class="btn btn-secondary"><i
                                class="bi bi-arrow-clockwise"></i> Reset Filter</a>
                        <a href="{{ route('export.ppid.psapi', request()->query()) }}" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export to Excel
                        </a>
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
                                                href="{{ route('detail.ppid.psapi', $item->belisapi_id) }}"><i
                                                    class="bi bi-info-lg"></i></a>
                                            <form id="deleteForm"
                                                action="{{ route('delete.ppid.psapi', $item->belisapi_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="showDeleteModal('{{ route('delete.ppid.psapi', $item->belisapi_id) }}')">
                                                    <i class="bi bi-trash-fill"></i>
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