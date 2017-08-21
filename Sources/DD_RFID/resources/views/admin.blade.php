<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang quản trị</title>
    @include('link_views.import')
</head>

 <body class="container-fluid" style="background-color: #f0f6f6;"> 
    <div class=" row">
        @include('link_views.ad_menu') 
        @yield('chart')
        @yield('event')
        @yield('student')
        @yield('staff')
    </div>
</body>
</html>