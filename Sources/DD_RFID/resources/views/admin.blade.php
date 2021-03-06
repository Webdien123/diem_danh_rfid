{{--  Định nghĩa trang quản trị  --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('link_views.import')
    <link rel="stylesheet" href="{{ asset('css/back_to_top.css') }}">
    <script src="{{ asset('js/back_to_top.js') }}"></script>
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

        {{--  Gọi hiển thị GD thông tin cán bộ  --}}
        @yield('staff_info')

        @yield('timcanbo')

        {{--  Gọi hiển thị GD đăng ký thẻ  --}}
        @yield('card')

        <a id="back-to-top" href="#" class="btn btn-warning btn-lg back-to-top" role="button" 
        title="Lên đầu trang" data-toggle="tooltip" data-placement="left">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        
    </div>
</body>
</html>