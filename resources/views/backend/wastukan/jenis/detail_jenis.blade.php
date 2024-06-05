@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="row">
            @isset($rumput)
            @foreach ($rumput as $item)
        </div>
        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail Rumput</h5>


                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">ID Rumput</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->id }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Jenis Rumput</div>
                            <div class="col-lg-9 col-md-8"> : Rumput {{ $item->jenis_rumput }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Kode Rumput</div>
                            <div class="col-lg-9 col-md-8"> : <b>{{ $item->kode_rumput }}</b> </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 label">Deskripsi</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->deskripsi_rumput }}</div>
                        </div>
                        <a href="{{ route('editjenis', $item->id) }}" class="btn btn-outline-warning edit"><i
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
