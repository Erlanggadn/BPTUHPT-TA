@extends('layouts.utama.main')

@section('content')

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12" id="kepala">
                <div class="text-center mb-4" id="merk">
                    <img src="{{ asset('img/peternakan.png') }}" alt="" class="img-fluid mx-2"
                        style="max-height: 50px;">
                    <img src="{{ asset('img/pkh.png') }}" alt="" class="img-fluid mx-2" style="max-height: 50px;">
                    <img src="{{ asset('img/bptu.png') }}" alt="" class="img-fluid mx-2" style="max-height: 50px;">
                </div>
                <div class="text-center mb-4" id="header" class="judul">
                    <h2>BPTU HPT Padang Mengatas</h2>
                    <h4>Bukti Pengajuan Pembelian Ternak</h4>
                </div>
            </div>

            <div id="content">
                <div class="box">
                    <table class="table" id="tabel">
                        <tr>
                            <td>Kode Transaksi/ Pengajuan</td>
                            <td>{{ $pengajuan->belisapi_id }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $pengajuan->belisapi_status }}</td>
                        </tr>
                        <tr>
                            <td>Nama Pembeli</td>
                            <td>{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_nama : '' }}</td>
                        </tr>
                        <tr>
                            <td>Asal Instansi</td>
                            <td>{{ $currentUser->pembeli ? $currentUser->pembeli->pembeli_instansi : '' }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $currentUser->pembeli ? $currentUser->email : '' }}</td>
                        </tr>
                        <tr>
                            <td>Nomor HP Perusahaan/Instansi</td>
                            <td>{{ $pengajuan->belisapi_nohp }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>{{ \Carbon\Carbon::parse($pengajuan->belisapi_tanggal)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Alasan Pembelian</td>
                            <td>{{ $pengajuan->belisapi_alasan }}</td>
                        </tr>

                        @foreach ($pengajuan->details as $detail)
                        <tr>
                            @foreach($sapiJenis as $jenis)
                            <td>Jenis Sapi</td>
                            <td>{{ $jenis->sjenis_nama }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Kategori Sapi</td>
                            <td>{{ $detail->detail_kategori }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Sapi</td>
                            <td>{{ $detail->detail_jumlah }}</td>
                        </tr>
                        <tr>
                            <td>Estimasi Berat (KG)</td>
                            <td>{{ $detail->detail_berat }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $detail->detail_kelamin }}</td>
                        </tr>
                        @endforeach

                        @if($pembayaran)
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>{{ $pembayaran->dbeli_sudah }}</td>
                        </tr>
                        <tr>
                            <td>Verifikasi pembayaran</td>
                            <td>{{ $pembayaran->dbeli_status }}</td>
                        </tr>
                    </table>
                    @else
                    <div class="text-danger text-center">Data pembayaran tidak ditemukan atau belum diisi.</div>
                    <p class="">*Anda Belum memiliki tagihan pembayaran, Mohon menunggu sampai pengajuan anda disetujui.
                    </p>
                    @endif
                </div>

                {{-- Pesan Berdasarkan Status --}}
                @if($pengajuan->belisapi_status == 'Ditolak')
                <div class="text-center mt-4">
                    <p class="text-danger">Terima kasih telah melakukan pengajuan, maaf kami belum bisa melanjutkan
                        pesanan anda.</p>
                </div>
                @elseif($pengajuan->belisapi_status == 'Disetujui')
                <div class="text-center mt-4">
                    <p class="text-success">Terima kasih telah melakukan pengajuan. Jika anda telah melakukan
                        pembayaran, silahkan mendatangi kantor BPTU HPT Padang Mengatas.</p>
                </div>
                @endif
            </div>

            <div id="footer">
                <span>© BPTU HPT Padang Mengatas</span>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print(); // Membuka dialog cetak secara otomatis

            // Event listener untuk mendeteksi jika dialog cetak ditutup
            window.onafterprint = function() {
                window.history.back(); // Kembali ke halaman sebelumnya setelah dialog cetak ditutup
            };
        };
    </script>
</body>
@endsection