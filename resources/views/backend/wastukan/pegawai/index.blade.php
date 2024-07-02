@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, {{ Auth::user()->name }} sebagai {{ Auth::user()->role }}</h1>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pegawai wastukan</h5>
                        <p>Berikut ini adalah data hak akses akun yang sepenuhnya dikelola oleh <b>Admin
                            </b> BPTU HPT
                            Padang
                            Mengatas
                        </p>
                        <p>Jumlah Pegawai Keswan Saat Ini : <b>{{ $jumlahPWastukan }}</b></p>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Tgl Buat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($jumlahWastukan)
                                    @foreach ($jumlahWastukan as $item)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $item->id }}</span></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td><a class="btn btn-outline-success"
                                                href="{{ route('detail.pegawai.wastukan', $item->id) }}"><i
                                                    class="bi bi-info-lg"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<script src="{{ asset ('js/main.js') }}"></script>