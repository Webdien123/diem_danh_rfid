<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang quản trị</title>
    @include('link_views.import')
</head>



<?php

?>


@if (strpos ($_SERVER['REQUEST_URI'], 'student'))
    {!! '<body class="container-fluid bg-danger">' !!}
@else
    {!! '<body class="container-fluid bg-success">' !!}
@endif


{{--  <body class="container-fluid bg-success">  --}}
    <div class=" row">
          {{--  @include('header')    --}}
        @include('link_views.ad_menu') 
        @yield('chart')
        @yield('event')
        @yield('student')
        @yield('staff')
    </div>
</body>
</html>