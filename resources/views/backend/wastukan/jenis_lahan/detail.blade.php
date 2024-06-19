@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">

    <section class="section profile">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Detail Jenis Lahan</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">ID Jenis Lahan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisLahan->lahan_id }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Kode Lahan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisLahan->lahan_kode }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisLahan->lahan_nama }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Ukuran Lahan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisLahan->lahan_keterangan }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status</div>
                                <div class="col-lg-9 col-md-8"> : @if ($jenisLahan->lahan_aktif === 'Aktif')
                                    <span class="badge bg-success">{{ $jenisLahan->lahan_aktif }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ $jenisLahan->lahan_aktif }}</span>
                                    @endif</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Dibuat Pada</div>
                                <div class="col-lg-9 col-md-8"> :
                                    {{ $jenisLahan->created_at->translatedFormat('d F Y') }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Dibuat Oleh</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisLahan->created_nama }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Diupdate Oleh</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisLahan->updated_nama }}</div>
                            </div>

                            <a href="{{ route('edit.jenis.lahan', ['lahan_id' => $jenisLahan->lahan_id]) }}"
                                class="btn btn-outline-warning edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            {{-- <form action="{{ route('kandang_jenis.delete', $jenisKandang->kandang_id) }}"
                            method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus jenis kandang ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                            </form> --}}

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
        </div>
    </section>
</main>

// Modal Edit Berhasil
<div class="modal fade" id="successModalEditKandang" tabindex="-1" aria-labelledby="successModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Edit Jenis Kandang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Jenis kandang berhasil diubah.
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
        var successModal = new bootstrap.Modal(document.getElementById('successModalEditKandang'));
        successModal.show();
    });

</script>
@endif
