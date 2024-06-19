@include('layouts.utama.main2')
@include('layouts.keswan.navbar')
@include('layouts.keswan.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Hewan Ternak</h5>
                        <p>Berikut ini adalah data hewan ternak yang sepenuhnya dikelola oleh <b>Divisi Kesehatan
                                Hewan</b> BPTU HPT Padang Mengatas
                        </p>
                        <a class="btn btn-outline-success mb-4" href=""><i class="bi bi-file-earmark-spreadsheet"></i>
                            Cetak Excel</a>
                        <a class="btn btn-outline-danger mb-4" href=""><i class="bi bi-file-earmark-pdf-fill"></i> Cetak
                            PDF</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID Sapi</th>
                                    <th>Jenis</th>
                                    <th>Penyakit</th>
                                    <th>TTL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($sapi)
                                @foreach ($sapi as $item)
                                <tr>
                                    <td><span class="badge bg-primary">{{ $item->id }}</span></td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>{{ $item->riwayat_penyakit }}</td>
                                    <td>{{ $item->tanggal_lahir }}</td>

                                    <td><a class="btn btn-outline-warning" target="_blank"
                                            href="{{ route('printsapi', $item->id) }}"><i class="bi bi-upc"></i></a> <a
                                            class="btn btn-outline-success"
                                            href="{{ route('detailsapi', $item->id) }}"><i
                                                class="bi bi-info-lg"></i></a>
                                        <form action="{{ route('deletesapi', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data sapi ini?')"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Template Main JS File -->
<script src="{{ asset ('js/main.js') }}"></script>
