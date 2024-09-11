@include('layouts.utama.main2')
@include('layouts.ppid.navbar')
@include('layouts.ppid.sidebar')

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Hak Akses Akun Pembeli</h5>
                        <p>Berikut ini adalah data hak akses akun yang sepenuhnya dikelola oleh <b>Admin dan Divisi
                                PPID</b> BPTU HPT Padang Mengatas</p>
                        <p>Jumlah Pembeli Saat Ini : <b>{{ $jumlahPembeli }}</b></p>
                        {{-- <a class="btn btn-outline-success mb-4" href=""><i
                                class="bi bi-file-earmark-spreadsheet"></i>
                            Cetak Excel</a>
                        <a class="btn btn-outline-danger mb-4" href="" target="_blank"><i
                                class="bi bi-file-earmark-pdf-fill"></i> Cetak PDF</a> --}}

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Nama Pembeli</th>
                                        <th>No. HP</th>
                                        <th>Tgl Buat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($akunuser)
                                    @foreach ($akunuser as $item)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $item->pembeli->pembeli_id }}</span></td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->pembeli->pembeli_nama ?? 'N/A' }}</td>
                                        <td>{{ $item->pembeli->pembeli_nohp ?? 'N/A' }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <a class="btn btn-outline-success"
                                                href="{{ route('detail.ppid.pembeli', ['id' => $item->user_id]) }}">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                            <form action="{{ route('akunadmin.delete', ['id' => $item->user_id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                                    <i class="bi bi-person-x-fill"></i>
                                                </button>
                                            </form>
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

</main><!-- End #main -->
<script src="{{ asset('js/main.js') }}"></script>