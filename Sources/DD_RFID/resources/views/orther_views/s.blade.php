{{--  Trang thử nghiệm section cho blade template  --}}

@extends('orther_views.m')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection