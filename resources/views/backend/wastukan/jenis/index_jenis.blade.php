@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Jenis Rumput</h5>
                        <p>Berikut ini adalah data Jenis Rumput yang sepenuhnya dikelola oleh <b>Divisi Pengawas Mutu
                                Pakan</b> BPTU HPT Padang Mengatas
                        </p>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis</th>
                                    <th>Kode Rumput</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($rumput)
                                @foreach ($rumput as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->jenis_rumput }}</td>
                                    <td><span class="badge bg-primary">{{ $item->kode_rumput }}</span></td>
                                    <td> <a class="btn btn-outline-success"
                                            href="{{ route('detailjenis', $item->id) }}"><i
                                                class="bi bi-info-square-fill"></i></a>
                                        <form action="{{ route('deletejenis', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data sapi ini?')"><i
                                                    class="bi bi-trash-fill"></i></button>
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
