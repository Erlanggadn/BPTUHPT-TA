@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Jenis Lahan</h5>
                        <p>Berikut ini adalah data Jenis Lahan yang sepenuhnya dikelola oleh <b>Divisi Pengawas Mutu
                                Pakan</b> BPTU HPT Padang Mengatas
                        </p>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif


                        <a href="{{ route('show.jenis.lahan') }}" class="btn btn-primary mb-4"><i
                                class="bi bi-plus"></i> Tambah Jenis</a>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Lahan</th>
                                    <th>Nama Lahan</th>
                                    <th>Ukuran Lahan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($JenisLahan)
                                @foreach ($JenisLahan as $item)
                                <tr>
                                    <td>{{ $item->lahan_id }}</td>
                                    <td><span class="badge bg-primary">{{ $item->lahan_kode }}</span></td>
                                    <td>{{ $item->lahan_nama }}</td>
                                    <td>{{ $item->lahan_keterangan }}</td>
                                    <td>@if ($item->lahan_aktif === 'Aktif')
                                        <span class="badge bg-success">{{ $item->lahan_aktif }}</span>
                                        @else
                                        <span class="badge bg-danger">{{ $item->lahan_aktif }}</span>
                                        @endif</span></td>
                                    <td> <a class="btn btn-outline-success"
                                            href="{{ route('detail.jenis.lahan', $item->lahan_id) }}"><i
                                                class="bi bi-info-lg"></i></a>
                                        <form id="deleteForm"
                                            action="{{ route('destroy.jenis.lahan', $item->lahan_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="showDeleteModal('{{ route('destroy.jenis.lahan', $item->lahan_id) }}')">
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
                    <p>Apakah Anda yakin ingin menghapus data jenis lahan ini?</p>
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
