@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <section class="section profile">
        @isset($sapi)
        <div class="">
            <div class="card">
                <div class="card-body pt-3">

                    <div class="tab-content pt-2">
                        <h5 class="card-title">Profil Sapi</h5>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('update.sapi.wasbitnak', $sapi->sapi_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">ID Sapi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $sapi->sapi_id }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">ID Induk Sapi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="sapi_no_induk" class="form-control"
                                        value="{{ $sapi->sapi_no_induk }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Jenis</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $sapi->jenisSapi->sjenis_nama }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Urutan Lahir</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $sapi->sapi_urutan_lahir }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{ $sapi->sapi_tanggal_lahir->format('d-m-Y') }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="sapi_keterangan"
                                        class="form-control">{{ $sapi->sapi_keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Status Sapi</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="sapi_status" id="sapi_status" class="form-control" required>
                                        <option value="">{{ $sapi->sapi_status }}</option>
                                        <option value="" disabled>-- Pilih Status --</option>
                                        <option value="Hamil">Hamil</option>
                                        <option value="Menyusui">Menyusui</option>
                                        <option value="Siap Jual">Siap Jual</option>
                                        <option value="Produktif">Produktif</option>
                                        <option value="Pemeriksaan/Sakit">Pemeriksaan/Sakit</option>
                                        <option value="Karantina">Karantina</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-success">Update</button>
                                <a href="{{ route('index.sapi.wasbitnak') }}"
                                    class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>

                    </div>

                </div><!-- End Bordered Tabs -->

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
                    Data sapi berhasil diperbarui.
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
