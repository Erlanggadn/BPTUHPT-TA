<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .error-container h1 {
            font-size: 6rem;
            margin-bottom: 1rem;
            color: #dc3545;
        }
        .error-container p {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .error-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
        }
        .error-container a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .error-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <p>Oops! Halaman yang Anda cari tidak ditemukan.</p>
        <img src="{{ asset('img/404.gif') }}" alt="Page Not Found">
        <a href="{{ url()->previous() }}">Kembali ke halaman sebelumnya</a>
    </div>
</body>
</html>
