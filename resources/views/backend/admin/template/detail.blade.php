<main id="main" class="main">
    <section class="section profile">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Profil Pengguna</h5>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">ID Akun</div>
                                <div class="col-lg-9 col-md-8">: {{ $akunuser->user_id }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Status/Jabatan</div>
                                <div class="col-lg-9 col-md-8">: {{ $akunuser->role }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Kode Pegawai </div>
                                <div class="col-lg-9 col-md-8">: {{ $akunuser->pegawai->pegawai_id }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Nama </div>
                                <div class="col-lg-9 col-md-8">: {{ $akunuser->pegawai->pegawai_nama }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">NIP </div>
                                <div class="col-lg-9 col-md-8">: {{ $akunuser->pegawai->pegawai_nip }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Alamat </div>
                                <div class="col-lg-9 col-md-8">: {{ $akunuser->pegawai->pegawai_alamat }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">No.Hp </div>
                                <div class="col-lg-9 col-md-8">: {{ $akunuser->pegawai->pegawai_nohp }}</div>
                            </div>

                            @if(Auth::user()->role == 'admin')
                            <a class="btn btn-outline-success"
                                href="https://wa.me/{{ $akunuser->pegawai_nohp }}?text=Kami%20dari%20BPTU%20HPT%20Padang%20Mengatas"
                                target="_blank">
                                <i class="bi bi-whatsapp"></i> Whatsapp
                            </a>
                            <a href="{{ route('admin.profil.edit', ['user_id' => $akunuser->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @if(Auth::user()->role == 'keswan')
                            <a href="{{ route('edit.profil.keswan', ['user_id' => $akunuser->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @if(Auth::user()->role == 'wasbitnak')
                            <a href="{{ route('edit.profil.wasbitnak', ['user_id' => $akunuser->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @if(Auth::user()->role == 'ppid')
                            <a href="{{ route('edit.profil.ppid', ['user_id' => $akunuser->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @if(Auth::user()->role == 'pembeli')
                            <a href="{{ route('edit.profil.ppid', ['user_id' => $user->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @if(Auth::user()->role == 'kepala')
                            <a href="{{ route('edit.profil.kepala', ['user_id' => $akunuser->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @if(Auth::user()->role == 'wastukan')
                            <a href="{{ route('edit.profil.wastukan', ['user_id' => $akunuser->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @if(Auth::user()->role == 'bendahara')
                            <a href="{{ route('edit.profil.bendahara', ['user_id' => $akunuser->user_id]) }}"
                                class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>
</main>

<script src="{{ asset('js/main.js') }}"></script>

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