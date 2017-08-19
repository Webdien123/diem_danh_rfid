<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang đăng nhập</title>
    @include('link_views.import')
</head>
<body>
    @include('link_views.header')
    <h1>Trang đăng nhập</h1>
    <h2>Nội dung đang cập nhật</h2>
    <a class="btn btn-default" href="{{ route('admin') }}" role="button">Trang quản trị</a>
    <a class="btn btn-default" href="{{ route('home') }}" role="button">Trang chủ</a>
</body>
</html>