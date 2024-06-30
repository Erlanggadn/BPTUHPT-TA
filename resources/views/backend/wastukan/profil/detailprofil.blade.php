@include('layouts.utama.main2')
@include('layouts.wastukan.navbar')
@include('layouts.wastukan.sidebar')

@section('content')

@include('backend.auth.detailprofil')
<script src="{{ asset ('js/main.js') }}"></script>
