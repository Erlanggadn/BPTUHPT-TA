@extends('layouts.utama.main2')
@include('layouts.admin.main')
@include('layouts.admin.sidebar')

@section('content')

@include('backend.admin.template.detail')

<script src="{{ asset ('js/main.js') }}"></script>