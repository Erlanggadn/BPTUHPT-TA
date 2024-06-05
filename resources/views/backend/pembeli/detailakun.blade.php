@include('layouts.utama.main')
@include('layouts.pembeli.header')

<h1>SELAMAT DATANG, {{ Auth::user()->name }}</h1>