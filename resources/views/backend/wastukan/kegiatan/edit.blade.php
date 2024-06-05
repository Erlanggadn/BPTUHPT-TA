@include('layouts.utama.main2')

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                        </div><!-- End Logo -->
                        @isset($wastukan)
                        <form action="{{ route('updatewastukan', ['id'=>$wastukan->id ]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ubah Data Kegiatan Wastukan</h5>
                                        <p class="text-center small">Pastikan Data Benar!</p>
                                    </div>
                                    <div class="row g-3 needs-validation" novalidate>
                                        {{-- <div class="col-12">
                                            <label for="nomor_lahan" class="form-label"><b>Nomor Lahan</b></label>
                                            <div class="input-group has-validation">
                                                <input type="text" value="{{ $wastukan->nomor_lahan }}"
                                        name="nomor_lahan" class="form-control" id="nomor_lahan" required>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-12">
                                            <label for="kode_rumput" class="form-label"><b>Kode Pakan</b></label>
                                            <select readonly name="kode_pakan" class="form-control" id="kode_rumput" required>
                                                @foreach($rumputs as $item)
                                                    <option value="{{ $item->kode_rumput }}"
                                {{ $wastukan->kode_pakan == $item->kode_rumput ? 'selected' : '' }}>{{ $item->jenis_rumput }}
                                </option>
                                @endforeach
                                </select>
                                <div class="invalid-feedback">Pilih kode pakan dengan benar</div>
                            </div> --}}
                            {{-- <div class="col-12">
                                        <label for="kode_pakan" class="form-label"><b>Kode Pakan</b></label>
                                        <input type="text" readonly name="kode_pakan"
                                            value="{{ $wastukan->kode_pakan }}" class="form-control" id="kode_pakan"
                            required>
                            <div class="invalid-feedback">Masukkan tanggal tanam dengan benar</div>
                    </div> --}}
                    {{-- <div class="col-12">
                                        <label for="tanggal_tanam" class="form-label"><b>Tanggal Tanam</b></label>
                                        <input type="date" name="tanggal_tanam" value="{{ $wastukan->tanggal_tanam }}"
                    class="form-control" id="tanggal_tanam" required>
                    <div class="invalid-feedback">Masukkan tanggal tanam dengan benar</div>
                </div> --}}
                <div class="col-12">
                    <label for="tanggal_panen" class="form-label"><b>Tanggal Panen</b></label>
                    <input type="date" name="tanggal_panen" value="{{ $wastukan->tanggal_panen }}" class="form-control"
                        id="tanggal_panen">
                    <div class="invalid-feedback">Masukkan tanggal panen dengan benar</div>
                </div>
                <div class="col-12">
                    <label for="kegiatan" class="form-label"><b>Kegiatan yang dilakukan</b></label>
                    <input id="kegiatan" class="form-control" value="{{ $wastukan->kegiatan }}" name="kegiatan"
                        required></input>
                    <div class="invalid-feedback">Masukkan kegiatan dengan benar</div>
                </div>
                <div class="col-12">
                    <label for="berat" class="form-label"><b>Berat (KG)</b></label>
                    <input type="number" name="berat" value="{{ $wastukan->berat }}" class="form-control" id="berat"
                        required>
                    <div class="invalid-feedback">Masukkan berat dengan benar</div>
                </div>
                <div class="col-12">
                    <label for="status" class="form-label"><b>Status</b></label>
                    <select name="status" class="form-control" id="status" required>
                        <option value="Sedang Berlangsung"
                            {{ $wastukan->status == 'Sedang Berlangsung' ? 'selected' : '' }}>Sedang
                            Berlangsung</option>
                        <option value="Selesai" {{ $wastukan->status == 'Selesai' ? 'selected' : '' }}>Selesai Panen
                        </option>
                    </select>
                    <div class="invalid-feedback">Pilih status dengan benar</div>
                </div>
                <div class="col-12">
                    <label for="pesan" class="form-label"><b>Pesan</b></label>
                    <input type="text" name="pesan" value="{{ $wastukan->pesan }}" class="form-control" id="pesan">
                    <div class="invalid-feedback">Masukkan pesan dengan benar</div>
                </div>
                <br>
                <div class="col-12">
                    <button class="btn btn-outline-success w-100" type="submit"><i class="bi bi-box-arrow-in-right"></i>
                        Simpan</button>
                </div>
                <br>
                <div class="col-12">
                    <a href="{{ route('detailwastukan', $wastukan->id) }}" class="btn btn-outline-secondary w-100"><i
                            class="bi bi-house-door-fill"> Kembali</i>
                    </a>
                </div>
                <br>
            </div>
    </div>
    </div>
    </form>
    @endisset
    </div>
    </div>
    </div>
    </section>
    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
