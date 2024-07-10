@include('layouts.utama.main2')
@include('layouts.ppid.navbar')
@include('layouts.ppid.sidebar')

<main id="main" class="main">
    <section class="section profile">
        @isset($akunuser)
        <div class="">
            <div class="card">
                <div class="card-body pt-3">

                    <div class="tab-content pt-2">
                        <h5 class="card-title">Profil Pembeli</h5>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('update.ppid.pembeli', $akunuser->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="email" name="email" class="form-control" value="{{ $akunuser->email }}"
                                        disabled>
                                </div>
                            </div>
                            @isset($pembeli)
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">ID Pembeli</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control" value="{{ $pembeli->pembeli_id }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Nama</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="pembeli_nama" class="form-control"
                                        value="{{ $pembeli->pembeli_nama }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Asal Instansi</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="pembeli_instansi" class="form-control"
                                        value="{{ $pembeli->pembeli_instansi }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8">
                                    <textarea type="text" name="pembeli_alamat" class="form-control"
                                        value="{{ $pembeli->pembeli_alamat }}"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="date" name="pembeli_lahir" class="form-control"
                                        value="{{ $pembeli->pembeli_lahir }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">No. HP</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" name="pembeli_nohp" class="form-control"
                                        value="{{ $pembeli->pembeli_nohp }}">
                                </div>
                            </div>
                            @endisset


                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label">Tanggal Buat</div>
                                <div class="col-lg-9 col-md-8">
                                    <input type="text" class="form-control"
                                        value="{{ $akunuser->created_at->format('d-m-Y') }}" disabled>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Ubah</button>
                                <a href="{{ route('index.daftar.pembeli') }}" class="btn btn-secondary">Kembali</a>
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
                    Data pembeli berhasil diperbarui.
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
