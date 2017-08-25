{{--  Định nghĩa trang chủ  --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    @include('link_views.import')
</head>
<body>
    @include('link_views.header')
    <h1>Trang chủ</h1>    
    <a class="btn btn-default" href="{{ route('admin') }}" role="button">Trang quản trị</a>
    <a class="btn btn-default" href="{{ route('login') }}" role="button">Trang đăng nhập</a>
</body>
</html>