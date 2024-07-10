@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        @isset($jenisLahan)
        <div class="">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail dan Edit Lahan</h5>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{ route('update.jenis.lahan', $jenisLahan->lahan_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">ID/Kode Lahan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $jenisLahan->lahan_id}}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama Lahan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $jenisLahan->lahan_nama}}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Jenis Tanah</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="lahan_jenis_tanah" class="form-control"
                                        value="{{ $jenisLahan->lahan_jenis_tanah }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Ukuran Lahan (m2)</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="number" name="lahan_ukuran" class="form-control"
                                        value="{{ $jenisLahan->lahan_ukuran }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="lahan_keterangan" class="form-control"
                                        value="{{ $jenisLahan->lahan_keterangan }}" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status Lahan</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="lahan_aktif" class="form-select" required>
                                        <option value="Aktif"
                                            {{ $jenisLahan->lahan_aktif == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="NonAktif"
                                            {{ $jenisLahan->lahan_aktif == 'NonAktif' ? 'selected' : '' }}>NonAktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Dibuat Pada</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $jenisLahan->created_at }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Di Update Pada</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $jenisLahan->updated_at }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-outline-success">Update</button>
                                <a href="{{ route('index.jenis.lahan') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endisset
    </section>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Jenis Lahan berhasil diperbarui.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        @if(session('success'))
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        @endif

    </script>
</main>
