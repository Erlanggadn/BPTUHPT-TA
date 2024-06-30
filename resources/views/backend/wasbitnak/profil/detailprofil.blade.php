@include('layouts.utama.main2')
@include('layouts.wasbitnak.navbar')
@include('layouts.wasbitnak.sidebar')

@section('content')

@include('backend.auth.detailprofil')
<script src="{{ asset ('js/main.js') }}"></script>
