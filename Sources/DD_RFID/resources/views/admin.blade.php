{{--  Định nghĩa trang quản trị  --}}

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
        {{--  Hiển thị menu  --}}
        @include('link_views.ad_menu') 

        {{--  Gọi hiển thị GD chart cho trang chart  --}}
        @yield('chart')

        {{--  Gọi hiển thị GD sự kiện cho trang sự kiện  --}}
        @yield('event')

        {{--  Gọi hiển thị GD sinh viên cho trang sinh viên  --}}
        @yield('student')

        {{--  Gọi hiển thị GD cán bộ cho trang cán bộ  --}}
        @yield('staff')
    </div>
</body>
</html>