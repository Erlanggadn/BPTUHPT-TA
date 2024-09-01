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
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Detail Jenis Sapi</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Kode Jenis Sapi</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisSapi->sjenis_id }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama Jenis Sapi</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisSapi->sjenis_nama }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Keterangan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $jenisSapi->sjenis_keterangan }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Dibuat Pada</div>
                                <div class="col-lg-9 col-md-8"> :
                                    {{ $jenisSapi->created_at->translatedFormat('d F Y') }}</div>
                            </div>

                            <a href="{{ route('edit.jenis.sapi', ['sjenis_id' => $jenisSapi->sjenis_id]) }}"
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