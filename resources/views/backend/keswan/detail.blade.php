@include('layouts.utama.main2')
@include('layouts.keswan.navbar')
@include('layouts.keswan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        @isset($sapi)
        @foreach ($sapi as $item)
        <div class="">

            <div class="card">
                <div class="card-body pt-3">

                    <div class="tab-content pt-2">
                        <h5 class="card-title">Profil Sapi</h5>


                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">ID Sapi</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">ID Induk Sapi</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->no_induk}}</div>
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


                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 label">Penyakit Sapi</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->riwayat_penyakit}}</div>
                        </div>
                        <a class="btn btn-outline-warning" href="{{ route('editsapi', $item->id) }}" class="edit"><i
                                class="bi bi-pencil-fill"></i> Edit</a>
                        <a class="btn btn-outline-primary" href="{{ route('printsapi', $item->id) }}" class="print"><i
                                class="bi bi-upc"></i></i> Cetak Kode</a>
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
