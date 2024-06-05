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
                        <h5 class="card-title">Data Sapi Siap Jual</h5>
                        <p>Berikut ini adalah data Kandang yang sepenuhnya dikelola oleh <b>Divisi Pengawas Bibit
                                Ternak dan Divisi PPID</b> BPTU HPT Padang Mengatas
                        </p>
                        <a href="{{ route('sapi-jual.create') }}" class="btn btn-primary mb-4"><i
                                class="bi bi-plus"></i> Tambah</a>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Sapi</th>
                                    <th>Jenis Sapi</th>
                                    <th>No induk</th>
                                    <th>Tanggal Siap</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($sapiJuals)
                                @foreach ($sapiJuals as $sapiJual)
                                <tr>
                                    <td>{{ $sapiJual->id_jual }}</td>
                                    <td>{{ $sapiJual->kode_sapi }}</td>
                                    <td>{{ $sapiJual->jenis_sapi }}</td>
                                    <td>{{ $sapiJual->sapi->no_induk }}</td>
                                    <td>{{ $sapiJual->tgl_siap }}</td>
                                    <td>@if ($sapiJual->status === 'Siap Jual')
                                        <span class="badge bg-success">{{ $sapiJual->status }}</span>
                                        @else
                                        <span class="badge bg-warning">{{ $sapiJual->status }}</span>
                                        @endif</span></td>
                                    <td>
                                        <a href="{{ route('sapi-jual.edit', $sapiJual->id_jual) }}"
                                            class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('sapi-jual.destroy', $sapiJual->id_jual) }}"
                                            method="POST" style="display:inline;">
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
<script src="{{ asset('js/main.js') }}"></script>
