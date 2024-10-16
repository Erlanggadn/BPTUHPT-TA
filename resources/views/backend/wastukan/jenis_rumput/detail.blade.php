@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        @isset($jenisRumput)
        <div class="">
            <div class="card">
                <div class="card-body pt-3">

                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail Rumput</h5>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('update.jenis.rumput', ['rum_id' => $jenisRumput->rum_id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">ID/Kode Jenis Rumput</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $jenisRumput->rum_id}}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama Rumput</div>
                                <div class="col-lg-9 col-md-8">
                                    <input name="rum_nama" type="text" class="form-control"
                                        value="{{ $jenisRumput->rum_nama }}">
                                </div>
                            </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label">Keterangan</div>
                        <div class="col-lg-9 col-md-8">
                            <textarea name="rum_keterangan"
                                class="form-control">{{ $jenisRumput->rum_keterangan }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <a href="{{ route('index.jenis.rumput') }}" class="btn btn-secondary">Kembali</a>
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
