@include('layouts.utama.main2')
@include('layouts.keswan.navbar')
@include('layouts.keswan.sidebar')

@section('content')

@include('backend.auth.detailprofil')
<script src="{{ asset ('js/main.js') }}"></script>
