@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <section class="section profile">
        @isset($Kandang)
        <div class="">
            <div class="card">
                <div class="card-body pt-3">

                    <div class="tab-content pt-2">
                        <h5 class="card-title">Profil Kandang</h5>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('update.kandang', $Kandang->kand_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">ID Sapi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $Kandang->kand_id }}" disabled>
                                </div>
                            </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Kode Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <input name="kand_kode" type="text" class="form-control" value="{{ $Kandang->kand_kode }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tipe Kandang ID</div>
                                <div class="col-lg-9 col-md-8">
                                    <input name="kand_jenis" type="text" class="form-control" value="{{ $Kandang->kand_jenis }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Tipe Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="kand_jenis" class="form-select">
                                        @foreach($jenisList as $jenis)
                                        <option value="{{ $jenis->kandang_id }}">{{ $jenis->kandang_tipe }} -
                                            {{ $jenis->kandang_nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="kand_keterangan"
                                        class="form-control">{{ $Kandang->kand_keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="kand_aktif" class="form-select">
                                        <option value="Aktif"
                                                    {{ $Kandang->kand_aktif == 'Aktif' ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="NonAktif"
                                                    {{ $Kandang->kand_aktif == 'NonAktif' ? 'selected' : '' }}>Non
                                                    Aktif
                                                </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Dibuat Oleh</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="kand_keterangan"
                                        class="form-control" disabled>{{ $Kandang->created_nama }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Diupdate Oleh</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="kand_keterangan"
                                        class="form-control" disabled>{{ $Kandang->updated_nama }}</textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-success">Update</button>
                                <a href="{{ route('index.kandang') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>

                        {{-- <a class="btn btn-outline-warning mt-3" href="{{ route('editsapi', $sapi->id) }}"><i
                            class="bi bi-pencil-fill"></i> Edit</a>
                        <a class="btn btn-outline-primary mt-3" href="{{ route('printsapi', $sapi->id) }}"><i
                                class="bi bi-upc"></i> Cetak Kode</a> --}}

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
