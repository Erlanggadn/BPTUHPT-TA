@extends('layouts.utama.main2')
@extends('layouts.wastukan.navbar')
@extends('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kegiatan Lahan</h5>
                        <p>Berikut ini adalah data kegiatan yang sepenuhnya dikelola oleh <b>Divisi Pengawas Mutu
                                Pakan</b> BPTU HPT Padang Mengatas</p>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <a href="{{ route('show.tanam') }}" class="btn btn-primary mb-4"><i class="bi bi-plus"></i>
                            Tambah Kegiatan</a>
                        <form action="{{ route('index.tanam') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="start_date" class="form-label">Dari Tanggal</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date" class="form-label">Sampai Tanggal</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        value="{{ request('end_date') }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i>
                                        Filter</button>
                                    <a href="{{ route('index.tanam') }}" class="btn btn-secondary"><i
                                            class="bi bi-x"></i> Reset</a>
                                    <a href="{{ route('export.tanam', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'lahan' => request('lahan')]) }}"
                                        class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Export to
                                        Excel</a>

                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Lahan</th>
                                        <th>Rumput</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($kegiatanLahan)
                                    @foreach ($kegiatanLahan as $kegiatan)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $kegiatan->tanam_id }}</span></td>
                                        <td>{{ $kegiatan->lahan->lahan_nama }}</td>
                                        <td>{{ $kegiatan->rumput->rumput_id }}
                                            [{{ $kegiatan->rumput->jenisRumput->rum_nama }} -
                                            {{ $kegiatan->rumput->rumput_berat_awal }} KG]</td>
                                        <td>{{ \Carbon\Carbon::parse($kegiatan->tanam_tanggal)->translatedFormat('d F Y') }}
                                            [{{ $kegiatan->tanam_jam_mulai }} - {{ $kegiatan->tanam_jam_selesai }}]</td>
                                        <td>
                                            @if ($kegiatan->tanam_status === 'Selesai')
                                            <span class="badge bg-success">{{ $kegiatan->tanam_status }}</span>
                                            @elseif ($kegiatan->tanam_status === 'Proses')
                                            <span class="badge bg-warning">{{ $kegiatan->tanam_status }}</span>
                                            @else
                                            <span class="badge bg-danger">{{ $kegiatan->tanam_status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-warning"
                                                href="{{ route('detail.tanam', $kegiatan->tanam_id) }}"><i
                                                    class="bi bi-info-lg"></i></a>
                                            <form id="deleteForm-{{ $kegiatan->tanam_id }}"
                                                action="{{ route('destroy.tanam', $kegiatan->tanam_id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="showDeleteModal('{{ $kegiatan->tanam_id }}')">
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
                    <p>Apakah Anda yakin ingin menghapus data kegiatan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</main>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    function showDeleteModal(id) {
        var deleteForm = document.getElementById('deleteForm-' + id);
        deleteForm.action = deleteForm.action;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();

        document.getElementById('confirmDelete').onclick = function () {
            deleteForm.submit();
        };
    }

</script>
