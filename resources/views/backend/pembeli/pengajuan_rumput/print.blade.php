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
                    <h4>Bukti Pengajuan Pembelian Rumput</h4>
                </div>
            </div>

            <div id="content">
                <div class="box">
                    <table class="table" id="tabel">
                        <tr>
                            <td>Kode Transaksi/Pengajuan</td>
                            <td>{{ $pengajuan->belirum_id }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $pengajuan->belirum_status }}</td>
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
                            <td>{{ $pengajuan->belirum_nohp }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>{{ \Carbon\Carbon::parse($pengajuan->belirum_tanggal)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Alamat Perusahaan/Instansi</td>
                            <td>{{ $pengajuan->belirum_alamat }}</td>
                        </tr>
                        <tr>
                            <td>Alasan Pembelian/Keterangan</td>
                            <td>{{ $pengajuan->belirum_alasan }}</td>
                        </tr>

                        @foreach ($pengajuan->detailPengajuanRumput as $detail)
                        <tr>
                            <td>Kategori Rumput</td>
                            <td>{{ $detail->drumput_kategori }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Rumput</td>
                            <td>{{ $detail->jenisRumput->rum_nama }}</td>
                        </tr>
                        <tr>
                            <td>Berat Rumput (KG)</td>
                            <td>{{ $detail->drumput_berat }}</td>
                        </tr>
                        <tr>
                            <td>Satuan Per</td>
                            <td>{{ $detail->drumput_satuan }}</td>
                        </tr>
                        @endforeach

                        @if($pembayaran)
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>{{ $pembayaran->bayarrum_sudah }}</td>
                        </tr>
                        <tr>
                            <td>Verifikasi Pembayaran</td>
                            <td>{{ $pembayaran->bayarrum_status }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                {{-- Pesan Berdasarkan Status --}}
                @if($pengajuan->belirum_status == 'Sedang Diproses')
                <div class="text-center mt-4">
                    <p class="text-dark">Terima kasih telah melakukan pengajuan, Status pengajuan anda saat ini adalah
                        <b>Sedang Diproses</b>
                    </p>
                </div>
                @elseif($pengajuan->belirum_status == 'Ditolak')
                <div class="text-center mt-4">
                    <p class="text-danger">Terima kasih telah melakukan pengajuan, maaf kami belum bisa melanjutkan
                        pesanan anda.</p>
                </div>
                @elseif($pengajuan->belirum_status == 'Disetujui')
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