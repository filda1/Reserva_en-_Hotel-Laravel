
@extends('layouts/app')
<script>window.location = "/";</script>
@include('layouts/head7')
@section('head')

@section('main-content')
    <h1>Success!! </h1>
    {{ $e_message}}
@endsection
@section('footer')
@endsection