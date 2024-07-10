@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Sapi</h5>
                        <p>Berikut ini adalah data Sapi yang sepenuhnya dikelola oleh <b>Divisi Kesehatan Hewan</b> BPTU
                            HPT Padang Mengatas
                        </p>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <a href="{{ route('export.sapi.wasbitnak', ['jenis_sapi' => request('jenis_sapi')]) }}"
                            class="btn btn-success mb-4">
                            <i class="bi bi-file-earmark-excel"></i> Export to Excel
                        </a>
                        <form action="{{ route('filter.sapi.wasbitnak') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="jenis_sapi" class="form-select">
                                        <option value="">Semua Sapi</option>
                                        @foreach($jenisList as $jenis)
                                        <option value="{{ $jenis->sjenis_id }}">{{ $jenis->sjenis_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="bulan_lahir" class="form-select">
                                        <option value="">Semua Bulan Lahir</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="tahun_lahir" class="form-select">
                                        <option value="">Semua Tahun Lahir</option>
                                        @for($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i>
                                        Filter</button>
                                </div>
                            </div>
                        </form>


                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID/Kode Sapi</th>
                                        <th>jenis Sapi</th>
                                        <th>Umur Sapi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($Sapi)
                                    @foreach ($Sapi as $item)
                                    <tr>
                                        <td>{{ $item->sapi_id }}</td>
                                        <td>{{ $item->jenisSapi->sjenis_nama }}</td>
                                        <td>{{ $item->sapi_umur }} Bulan</td>
                                        <td>{{ $item->sapi_status }}</td>
                                        <td> <a class="btn btn-outline-success"
                                                href="{{ route('detail.sapi.wasbitnak', $item->sapi_id) }}"><i
                                                    class="bi bi-info-lg"></i></a>
                                            <form id="deleteForm"
                                                action="{{ route('destroy.sapi.wasbitnak', $item->sapi_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="showDeleteModal('{{ route('destroy.sapi.wasbitnak', $item->sapi_id) }}')">
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
                    <p>Apakah Anda yakin ingin menghapus data Sapi ini?</p>
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
