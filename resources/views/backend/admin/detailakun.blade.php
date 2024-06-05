@include('layouts.utama.main2')
@include('layouts.admin.main')
@include('layouts.admin.sidebar')

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

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status/Jabatan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->role}}</div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Password</div>
                                <div class="col-lg-9 col-md-8"> : *****</div>
                            </div>
                            <a class="btn btn-outline-success" href="https://wa.me/{{ $item->nohp }}" target="_blank"><i
                                    class="bi bi-whatsapp"></i> Whatsapp</a>
                            <a href="{{ route('akunadmin.edit', $item->id) }}" class="btn btn-outline-warning edit"><i
                                    class="bi bi-pencil-square"></i> Edit</a>
                            @endforeach
                            @endisset

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
        </div>
    </section>
