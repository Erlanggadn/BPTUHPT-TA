@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">

    <section class="section profile">
        <div class="row">
            @isset($akunuser)
            @foreach ($akunuser as $item)
            <div class="">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Profil Pengguna</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">ID Akun</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->id }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No.Hp</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->nohp }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->alamat }}</div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status/Jabatan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->role}}</div>
                            </div>
                            <a class="btn btn-outline-success"
                                href="https://wa.me/{{ $item->nohp }}?text=Kami%20dari%20BPTU%20HPT%20Padang%20Mengatas"
                                target="_blank">
                                <i class="bi bi-whatsapp"></i> Whatsapp
                            </a>
                            @endforeach
                            @endisset

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
        </div>
    </section>
</main>
//Modal Edit Berhasil
<div class="modal fade" id="successModalEditAkun" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Akun berhasil di ubah
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
        var successModal = new bootstrap.Modal(document.getElementById('successModalEditAkun'));
        successModal.show();
    });

</script>
@endif
