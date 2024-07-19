@include('layouts.utama.main2')
@include('layouts.admin.main')
@include('layouts.admin.sidebar')

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Hak Akses Akun Pembeli</h5>
                        <p>Berikut ini adalah data hak akses akun yang sepenuhnya dikelola oleh <b>Admin dan Divisi
                                PPID</b> BPTU HPT Padang Mengatas</p>
                        <form method="GET" action="{{ route('akunpembeli') }}" class="row mb-4">
                            <div class="col-md-2">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ $startDate ?? '' }}">
                            </div>
                            <div class="col-md-2">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ $endDate ?? '' }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary form-control"><i class="bi bi-funnel"></i>
                                    Filter</button>
                            </div>
                        </form>

                        <!-- Link Export ke Excel -->
                        <a href="{{ route('pembeli.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-success mb-4">
                            <i class="bi bi-file-earmark-excel"></i> Export ke Excel
                        </a>
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
                                        <td>{{ $item->pembeli->pembeli_id }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->pembeli->pembeli_nama ?? 'N/A' }}</td>
                                        <td>{{ $item->pembeli->pembeli_nohp ?? 'N/A' }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <a class="btn btn-outline-success"
                                                href="{{ route('detail.akun.pembeli', ['id' => $item->id]) }}">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                            <form action="{{ route('akunadmin.delete', ['id' => $item->id]) }}"
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
