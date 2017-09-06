{{-- Định nghĩa trang chủ --}}

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    @include('link_views.import')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    {{-- @include('link_views.header') --}}

    <!-- <img src="{{ asset('imgs/Banner3.jpg') }}" class="img-responsive" alt="Image"> -->
    <div id="home_bg"></div>
    <div class="container text-center" id="home_content">
        <h1>Điểm danh vào</h1>
        {{--  <h1>Điểm danh ra</h1>  --}}
        <h1><strong class="text-danger" style="font-size: 170%">TUẦN LỄ CHỦ NHẬT XANH VÀ MÙA HÈ XANH LÈ XANH LÉT XANH TÉT BÉT</strong></h1>
        {{--  <a class="btn btn-default" href="{{ route('admin') }}" role="button">
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            Trang quản trị
        </a>
        <a class="btn btn-default" href="{{ route('login') }}" role="button">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
            Trang đăng nhập
        </a>  --}}
        <hr>
        

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">KHUNG ĐIỂM DANH</h3>
            </div>
            <div class="panel-body">
                <!-- Phần quét thẻ -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <h1 class="text-center">Quét thẻ để điểm danh</h1>
                        <form action="{{ route('home') }}" method="post" id="f_quet_the">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="TuKhoa" placeholder="Quét thẻ cần đăng ký" required id="id_the">
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>