@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        @isset($rumput)
        <div class="">
            <div class="card">
                <div class="card-body pt-3">

                    <div class="tab-content pt-2">
                        <h5 class="card-title">Profil Rumput</h5>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('update.rumput', $rumput->rumput_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Kode Rumput</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $rumput->rumput_id}}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Jenis</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $rumput->jenisRumput->rum_nama }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Berat Rumput Awal (KG)</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="rumput_berat_awal" class="form-control"
                                        value="{{ $rumput->rumput_berat_awal }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Berat Rumput Hasil (KG)</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="rumput_berat_hasil" class="form-control"
                                        value="{{ $rumput->rumput_berat_hasil }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Masuk</div>
                                <div class="col-lg-9 col-md-8">
                                    <input name="rumput_masuk" type="date" class="form-control"
                                        value="{{ $rumput->rumput_masuk }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea name="rumput_keterangan"
                                        class="form-control">{{ $rumput->rumput_keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status Kandang</div>
                                <div class="col-lg-9 col-md-8">
                                    <select name="rumput_status" class="form-select">
                                        <option value="Bibit" {{ $rumput->rumput_status == 'Bibit' ? 'selected' : '' }}>
                                            Bibit
                                        </option>
                                        <option value="Baru Ditanam"
                                            {{ $rumput->rumput_status == 'Baru Ditanam' ? 'selected' : '' }}>Baru
                                            Ditanam
                                        </option>
                                        <option value="Siap Panen"
                                            {{ $rumput->rumput_status == 'Siap Panen' ? 'selected' : '' }}>Siap Panen
                                        </option>
                                        <option value="Stok Habis"
                                            {{ $rumput->rumput_status == 'Stok Habis' ? 'selected' : '' }}>Stok Habis
                                        </option>
                                        <option value="Rusak/Tidak Layak"
                                            {{ $rumput->rumput_status == 'Rusak/Tidak Layak' ? 'selected' : '' }}>
                                            Rusak/Tidak Layak
                                        </option>
                                        <option value="Siap Jual"
                                            {{ $rumput->rumput_status == 'Siap Jual' ? 'selected' : '' }}>Siap Jual
                                        </option>
                                        <option value="Siap Pakan"
                                            {{ $rumput->rumput_status == 'Siap Pakan' ? 'selected' : '' }}>Siap Pakan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Dibuat Oleh</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $rumput->created_nama }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Di Update Oleh</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $rumput->updated_nama}}" disabled>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-outline-success">Update</button>
                    <a href="{{ route('index.rumput') }}" class="btn btn-outline-secondary">Kembali</a>
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
