<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Sapi ID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .print-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .sapi-item {
            margin: 10px;
            border: 1px solid #000;
            padding: 20px;
            text-align: center;
        }
        @media print {
            .sapi-item {
                font-size: 48px; /* Besarkan tulisan saat diprint */
                page-break-inside: avoid; /* Hindari pemutusan halaman di tengah */
            }
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact; /* Pastikan warna sesuai saat diprint */
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        @isset($sapi)
            @foreach ($sapi as $item)
                <div class="sapi-item">
                    <h5>{{ $item->id }}</h5>
                </div>
            @endforeach
        @endisset
    </div>
    <script>
        window.onload = function() {
            window.print(); // Memulai print otomatis saat halaman dimuat
        };
    </script>
</body>
</html>
