@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kandang</h5>
                        <p>Berikut ini adalah data Kandang yang sepenuhnya dikelola oleh <b>Divisi Pengawas Bibit
                                Ternak</b> BPTU
                            HPT Padang Mengatas
                        </p>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <a href="{{ route('show.kandang') }}" class="btn btn-primary mb-4"><i class="bi bi-plus"></i>
                            Tambah Kandang</a>
                            
                        <form action="{{ route('filter.kandang') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="jenis_sapi" class="form-select">
                                        <option value="">Semua Tipe</option>
                                        @foreach($jenisList as $jenis)
                                        <option value="{{ $jenis->kandang_id }}">{{ $jenis->kandang_tipe }} -
                                            {{ $jenis->kandang_nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID Kandang</th>
                                    <th>Kode Kandang</th>
                                    <th>Jenis Kandang</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($Kandang)
                                @foreach ($Kandang as $item)
                                <tr>
                                    <td>{{ $item->kand_id }}</td>
                                    <td>{{ $item->kand_kode }}</td>
                                    <td>{{ $item->jenisKandang->kandang_tipe }} - {{ $item->jenisKandang->kandang_nama }}</td>
                                    <td>
                                        @if ($item->kand_aktif === 'Aktif')
                                        <span class="badge bg-success">{{ $item->kand_aktif }}</span>
                                        @else
                                        <span class="badge bg-danger">{{ $item->kand_aktif }}</span>
                                        @endif
                                    </td>
                                    <td> 
                                        <a class="btn btn-outline-success" href="{{ route('detail.kandang', $item->kand_id) }}"><i class="bi bi-info-lg"></i></a>
                                        <form id="deleteForm" action="{{ route('destroy.kandang', $item->kand_id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger" onclick="showDeleteModal('{{ route('destroy.kandang', $item->kand_id) }}')">
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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
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
