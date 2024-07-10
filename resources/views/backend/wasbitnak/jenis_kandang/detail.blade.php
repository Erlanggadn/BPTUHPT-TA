@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">

    <section class="section profile">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Detail Jenis Kandang</h5>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">ID Jenis Kandang</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisKandang->kandang_id }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Tipe Kandang</div>
                                <div class="col-lg-9 col-md-8"> : <span
                                        class="badge bg-secondary">{{ $jenisKandang->kandang_tipe }}</span></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisKandang->kandang_keterangan }}</div>
                            </div>

                            <div class="row  mb-4">
                                <div class="col-lg-3 col-md-4 label">Dibuat Pada</div>
                                <div class="col-lg-9 col-md-8"> :
                                    {{ $jenisKandang->created_at->translatedFormat('d F Y') }}</div>
                            </div>

                            <a href="{{ route('edit.jenis.kandang', ['kandang_id' => $jenisKandang->kandang_id]) }}"
                                class="btn btn-warning edit">
                                <i class="bi bi-pencil-square"></i> Ubah
                            </a>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
        </div>
    </section>
</main>

// Modal Edit Berhasil
<div class="modal fade" id="successModalEditRumput" tabindex="-1" aria-labelledby="successModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Edit Jenis Rumput</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Jenis rumput berhasil diubah.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@if(session('berhasil.edit'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successModal = new bootstrap.Modal(document.getElementById('successModalEditRumput'));
        successModal.show();
    });

</script>
@endif
