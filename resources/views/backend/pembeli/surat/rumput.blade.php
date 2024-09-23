<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Surat Pembelian Rumput</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            margin: 40px;
            line-height: 1.6;
        }

        .header {
            text-align: left;
            margin-bottom: 20px;
        }

        .header div {
            margin-bottom: 5px;
        }

        .content {
            text-align: justify;
        }

        .signature {
            margin-top: 40px;
            text-align: left;
        }

        .footer {
            margin-top: 20px;
            text-align: left;
        }

        .signature p,
        .footer p,
        .footer ol {
            margin: 0;
            padding: 0;
        }

        .signature img {
            width: 100px;
            /* Sesuaikan dengan ukuran stempel */
        }

    </style>
    <script>
        function printDocument() {
            var beforePrint = function () {
                console.log('Persiapan untuk mencetak...');
            };

            var afterPrint = function () {
                console.log('Selesai mencetak atau dibatalkan...');
                if (confirm('Apakah Anda ingin kembali ke halaman sebelumnya?')) {
                    window.history.back();
                }
            };

            if (window.matchMedia) {
                var mediaQueryList = window.matchMedia('print');
                mediaQueryList.addListener(function (mql) {
                    if (!mql.matches) {
                        afterPrint();
                    }
                });
            }

            window.onbeforeprint = beforePrint;
            window.onafterprint = afterPrint;

            window.print();
        }

    </script>
</head>

<body onload="printDocument()">
    <div class="header">
        <div>....</div>
        <div>...., Kecamatan .... Kabupaten ....</div>
        <div>....</div>
    </div>

    <div class="content">
        <p>Nomor: ....</p>
        <p>Lampiran: ....</p>
        <p>Perihal: Pembelian Benih Rumput</p>

        <p>Kepada Yth.</p>
        <p>Kepala Balai Pembibitan Ternak Unggul dan Hijauan Pakan Ternak (BPTU HPT) Padang Mengatas</p>
        <p>Jl. Padang Mengatas, Mungo, Kecamatan Luak</p>
        <p>Kabupaten Lima Puluh Kota</p>
        <p>Sumatera Barat</p>

        <p>Dengan Hormat,</p>

        <p>Bersama surat ini, kami dari ...., Nagari ...., Kecamatan ...., Kabupaten ...., Sumatera Barat, mengajukan
            permohonan pembelian benih rumput sebanyak .... kg. Benih rumput ini terdiri dari:</p>
        <ul>
            <li>Rumput .... (Bij) sebanyak .... kg</li>
            <li>Leguminosa Menjalar (Bij) .... kg</li>
            <li>Leguminosa Pohon (Bij) .... kg</li>
        </ul>

        <p>Adapun pembelian benih rumput ini ditujukan untuk memenuhi kebutuhan hijauan pakan ternak di wilayah kami.
            Kami berharap dapat mendukung program peningkatan ekonomi masyarakat sekitar serta mendukung pelestarian
            kawasan konservasi. Kami juga telah berkonsultasi dengan Kepala Balai Konservasi Sumber Daya Alam (BKSDA)
            Sumatera Barat terkait hal ini.</p>

        <p>Surat permohonan ini dapat dipertimbangkan dan direalisasikan sesuai prosedur yang berlaku di BPTU HPT Padang
            Mengatas. Kami siap untuk mengikuti ketentuan dan prosedur yang berlaku.</p>

        <p>Demikian surat ini kami sampaikan, atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
    </div>

    <div class="signature">
        <p>Hormat Kami,</p>
        <p>....</p>
        <p>....</p>
        <p><img src="stempel_ttd.png" alt="Stempel dan Tanda Tangan"></p>
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

</html>
