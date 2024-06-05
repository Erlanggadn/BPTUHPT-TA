@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Selamat Datang, <b>{{ Auth::user()->name }} </b> sebagai {{ Auth::user()->role }}</h1>
        <nav>
            <ol class="breadcrumb">
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kandang</h5>
                        <p>Berikut ini adalah data Jenis Kandang yang sepenuhnya dikelola oleh <b>Divisi Pengawas Bibit
                                Ternak</b> BPTU HPT Padang Mengatas
                        </p>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No Kandang</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($jenisKandang )
                                @foreach ($jenisKandang as $item)
                                <tr>
                                    <td>{{ $item->id_kandang }}</td>
                                    <td>{{ $item->no_kandang}}</td>
                                    <td>{{ $item->jenis_kandang}}</td>
                                    <td>
                                        @if ($item->status === 'Aktif')
                                        <span class="badge bg-success">{{ $item->status }}</span>
                                        @else
                                        <span class="badge bg-secondary">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td><a class="btn btn-outline-warning"
                                            href="{{ route('edit.jenis.kandang', $item->id_kandang) }}"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('deletejeniskandang', $item->id_kandang) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
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
