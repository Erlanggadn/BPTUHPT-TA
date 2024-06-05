@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Detail Kegiatan Kandang</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">ID Kegiatan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $kegiatanKandang->id_kegiatan }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kandang</div>
                                <div class="col-lg-9 col-md-8"> : <b>{{ $kegiatanKandang->kode_kandang }} </b></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status Kandang</div>
                                <div class="col-lg-9 col-md-8"> :
                                    @if ($kegiatanKandang->status === 'Selesai')
                                    <span class="badge bg-success">{{ $kegiatanKandang->status }}</span>
                                    @else
                                    <span class="badge bg-warning">{{ $kegiatanKandang->status }}</span>
                                    @endif</span></div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Deskripsi</div>
                                <div class="col-lg-9 col-md-8"> : {{ $kegiatanKandang->kegiatan }}</div>
                            </div>

                            <a class="btn btn-outline-success mb-4" data-bs-toggle="modal"
                                data-bs-target="#editModal">Edit</a>
                            @include('backend.wasbitnak.kegiatan.edit-sapi')

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Sapi dalam Kandang
                                        (<b>{{ $kegiatanKandang->kode_kandang }})</b></h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kode Sapi</th>
                                                <th scope="col">Jenis Sapi</th>
                                                <th scope="col">Penyakit</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kegiatanKandang->kegiatanSapi as $kegiatanSapi)
                                            <tr>
                                                <td>{{ $kegiatanSapi->sapi->id }}</td>
                                                <td>{{ $kegiatanSapi->sapi->jenis }}</td>
                                                <td>{{ $kegiatanSapi->sapi->riwayat_penyakit }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('hapusSapi', ['id_kegiatan' => $kegiatanSapi->id_kegiatan, 'id_sapi' => $kegiatanSapi->kode_sapi]) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="bi bi-x-circle-fill"></i> Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <a href="{{ route('getSapi', ['id_kegiatan' => $kegiatanKandang->id_kegiatan]) }}"
                                        class="btn btn-primary mb-4"><i class="bi bi-plus"></i> Tambah Sapi</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Template Main JS File -->
<script src="{{ asset('js/main.js') }}"></script>
