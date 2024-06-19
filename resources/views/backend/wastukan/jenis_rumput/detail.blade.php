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
                            <h5 class="card-title">Detail Jenis Rumput</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">ID Jenis Rumput</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisRumput->rum_id }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Kode</div>
                                <div class="col-lg-9 col-md-8"> : <span
                                        class="badge bg-primary">{{ $jenisRumput->rum_kode }}</span></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisRumput->rum_nama }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisRumput->rum_keterangan }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status</div>
                                <div class="col-lg-9 col-md-8"> : @if ($jenisRumput->rum_aktif === 'Aktif')
                                    <span class="badge bg-success">{{ $jenisRumput->rum_aktif }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ $jenisRumput->rum_aktif }}</span>
                                    @endif</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Dibuat Pada</div>
                                <div class="col-lg-9 col-md-8"> :
                                    {{ $jenisRumput->created_at->translatedFormat('d F Y') }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Dibuat Oleh</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisRumput->created_nama }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Diupdate Oleh</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisRumput->updated_nama }}</div>
                            </div>

                            <a href="{{ route('edit.jenis.rumput', ['rum_id' => $jenisRumput->rum_id]) }}"
                                class="btn btn-outline-warning edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            {{-- <form action="{{ route('rumput_jenis.delete', $jenisRumput->rum_id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus jenis rumput ini?')">
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
