<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang đăng nhập</title>
    @include('import')
</head>
<body>
    @include('header')
    <h1>Trang đăng nhập</h1>
    <a class="btn btn-default" href="{{ route('student') }}" role="button">Trang quản trị</a>
    <a class="btn btn-default" href="{{ route('home') }}" role="button">Trang chủ</a>
</body>
</html>