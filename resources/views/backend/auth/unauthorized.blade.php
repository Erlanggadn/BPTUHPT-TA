<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;

            font-family: Arial, sans-serif;
        }

        .unauthorized-container {
            text-align: center;
            max-width: 600px;
            width: 100%;
            padding: 20px;

            border-radius: 8px;
        }

        .unauthorized-container h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #000000;
        }

        .unauthorized-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
            width: 200px;
            /* Adjust the width as needed */
        }

        .unauthorized-container button {
            text-decoration: none;
            color: white;
            font-weight: bold;
            background-color: #dc3545;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            border: none;
        }

        .unauthorized-container button:hover {
            background-color: #bb2d3b;
        }

    </style>
</head>

<body>
    <div class="unauthorized-container">
        <h1><B>403</B></h1>
        {{-- <img src="{{ asset('img/403.gif') }}" alt="Unauthorized Access"> --}}
        <h1 class="text-center"><b>Ups.., Anda tidak dapat mengakses halaman ini</b></h1>
        <button onclick="history.back()" class="btn btn-danger">Kembali</button>
    </div>
</body>

</html>
