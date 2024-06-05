@include('layouts.utama.main2')
@include('layouts.keswan.navbar')
@include('layouts.keswan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    @isset($sapi)
                    @foreach ($sapi as $item)
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <h2>{{ $item->jenis }}</h2>
                        <h3>{{ $item->id }}</h3>
                        {{-- <img src="{{ asset('app/public/foto_sapi/' . $item->foto) }}" /> --}}
                        {{-- <img src="{{ asset('storage/public/' . $item->foto) }}" /> --}}
                        <div class="social-links mt-2">
                            <a class="btn btn-light" href="{{ route('editsapi', $item->id) }}" class="edit"><i
                                    class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-light" href="{{ route('printsapi', $item->id) }}" class="print"><i
                                    class="bi bi-fingerprint"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <h5 class="card-title">Profile Sapi</h5>


                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">ID Sapi</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->id }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->jenis }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Urutan Lahir</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->urutan_lahir }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->tanggal_lahir }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">ID Induk Sapi</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->no_induk}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Penyakit Sapi</div>
                                <div class="col-lg-9 col-md-8"> : {{ $item->riwayat_penyakit}}</div>
                            </div>
                            @endforeach
                            @endisset

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
        </div>
    </section>


    {{-- <script src="vendor/apexcharts/apexcharts.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/chart.js/chart.umd.js"></script>
<script src="vendor/echarts/echarts.min.js"></script>
<script src="vendor/quill/quill.min.js"></script>
<script src="vendor/simple-datatables/simple-datatables.js"></script>
<script src="vendor/tinymce/tinymce.min.js"></script>
<script src="vendor/php-email-form/validate.js"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{ asset ('js/main.js') }}"></script>
