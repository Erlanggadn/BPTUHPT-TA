<main id="main" class="main">
    <section class="section profile">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Profile Saya</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">ID Akun</div>
                                <div class="col-lg-9 col-md-8"> : {{ $akunuser->id }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama</div>
                                <div class="col-lg-9 col-md-8"> : {{ $akunuser->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No.Hp</div>
                                <div class="col-lg-9 col-md-8"> : {{ $akunuser->nohp }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8"> : {{ $akunuser->alamat }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Status/Jabatan</div>
                                <div class="col-lg-9 col-md-8"> : {{ $akunuser->role}}</div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 label">Password</div>
                                <div class="col-lg-9 col-md-8"> : *****</div>
                            </div>

                            
                            @if(auth()->user()->role == 'admin')
                            <a class="btn btn-outline-success" href="https://wa.me/{{ $akunuser->nohp }}"
                                target="_blank"><i class="bi bi-whatsapp"></i> Whatsapp</a>
                            <a class="btn btn-outline-secondary" href="#" class="telephone"><i
                                    class="bi bi-telephone-fill"></i> Telepon</a>
                            <a class="btn btn-outline-warning" href="{{ route('akunadmin.edit', $akunuser->id) }}"
                                class="edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
        </div>
    </section>
