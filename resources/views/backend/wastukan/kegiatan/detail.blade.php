@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">
    <section class="section profile">
        <div class="row">
            @isset($wastukan)
            @foreach ($wastukan as $item)
            <div class="card">
                <div class="card-body pt-3">

                    <div class="tab-content pt-2">
                        <h5 class="card-title">Detail Kegiatan Lahan</h5>


                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">ID Kegiatan</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->id }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Nomor Lahan</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->nomor_lahan }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Kode Rumput</div>
                            <div class="col-lg-9 col-md-8 "> : <span
                                    class="badge bg-primary"><b>{{ $item->kode_pakan }}</b></span> </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Jenis Rumput</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->rumput->jenis_rumput }} </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal Tanam</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->tanggal_tanam }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal Panen</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->tanggal_panen }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Kegiatan Lahan</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->kegiatan }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Berat (KG)</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->berat }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Status</div>
                            <div class="col-lg-9 col-md-8"> : @if ($item->status === 'Selesai')
                                <span class="badge bg-success">{{ $item->status }}</span>
                                @else
                                <span class="badge bg-warning">{{ $item->status }}</span>
                                @endif</span></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 label">Pesan</div>
                            <div class="col-lg-9 col-md-8"> : {{ $item->pesan }}</div>
                        </div>
                        <a href="{{ route('editwastukan', ['id'=>$item->id ] ) }}"
                            class="btn btn-outline-warning edit"><i class="bi bi-pencil-square"></i> Edit</a>
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
