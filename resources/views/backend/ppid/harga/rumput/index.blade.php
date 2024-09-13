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
                        <h5 class="card-title">Data Harga Rumput</h5>
                        <p>Berikut ini adalah data harga Rumput yang sepenuhnya dikelola oleh <b>Divisi PPID</b> BPTU
                            HPT Padang Mengatas
                        </p>
                        <a href="{{ route('show.harga.rumput') }}" class="btn btn-primary mb-4"><i
                                class="bi bi-plus"></i>
                            Tambah Harga</a>
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
                                        <th>ID Harga</th>
                                        <th>Jenis Rumput</th>
                                        <th>Jenis Pakan</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($hargarumput)
                                    @foreach ($hargarumput as $item)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $item->hr_id }}</span></td>
                                        <td>{{ $item->jenis->rum_nama }}</td>
                                        <td>{{ $item->hr_jenis }}</td>
                                        <td>{{ $item->hr_satuan }}</td>
                                        <td>{{ $item->hr_kategori }}</td>
                                        <td>Rp. {{ number_format($item->hr_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a class="btn btn-outline-success"
                                                href="{{ route('detail.harga.rumput', $item->hr_id) }}"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <form id="deleteForm{{ $item->hr_id }}"
                                                action="{{ route('delete.harga.rumput', $item->hr_id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="showDeleteModal('{{ route('delete.harga.rumput', $item->hr_id) }}', '{{ $item->hr_id }}')">
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
                    <p>Apakah Anda yakin ingin menghapus data Harga Sapi ini?</p>
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
    function showDeleteModal(action, id) {
        var deleteForm = document.getElementById('deleteForm' + id);
        deleteForm.action = action;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    document.getElementById('confirmDelete').addEventListener('click', function () {
        document.getElementById('deleteForm').submit();
    });
</script>