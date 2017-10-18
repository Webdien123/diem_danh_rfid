{{-- Định nghĩa trang chủ --}}

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    @include('link_views.import')

    {{--  Gọi css căn chỉnh ảnh nền và giao diện home  --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    {{--  Gọi script autosize của text tên sự kiện trên trang home  --}}
    <script src="{{ asset('js/jquery.fittext.js') }}"></script>

    {{--  Script tạo đồng hồ đếm ngược  --}}
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>

    {{--  Jquery điều khiển phần quét thẻ  --}}
    <script src="{{ asset('js/card.js') }}"></script>
</head>
<body>
    <?php
        $sukien = \Session::get('sukien_diemdanh');
        $sukien = $sukien[0];
    ?>

    {{--  Thẻ hiển thị ảnh nền  --}}
    <div id="home_bg"></div>

    {{--  Thẻ chứa nội dung trang home  --}}
    <div class="container text-center" id="home_content">

        {{--  Hiển thị điểm danh theo trạng thái sự kiện  --}}
        @if (Session::get('trangthai_sukien') == 2)
            <h1>Điểm danh vào</h1>
        @endif

        @if (Session::get('trangthai_sukien') == 3)
            <h1>Điểm danh ra</h1>
        @endif

        {{--  Tên sự kiện  --}}
        <h1><strong id="event_name" class="text-danger">
            {{ mb_strtoupper($sukien->TENSK, 'UTF-8') }}
        </strong></h1>

        {{--  Thời gian, địa điểm  --}}
        <div class="row">
            <div class="col-xs-12">
                <h2>Thời gian: <b>{{ $sukien->DDVAO }}</b> - Địa điểm: <b>{{ $sukien->DIADIEM }}</b></h2>
            </div>
        </div>

        {{--  Đồng hồ đếm thời gian còn lại  --}}
        
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                {{--  Hiển thị điểm danh theo trạng thái sự kiện  --}}
                @if (Session::get('trangthai_sukien') == 1)
                    <h1>sẽ điểm danh sau:</h1>
                @endif
        
                @if (Session::get('trangthai_sukien') == 3)
                    <h1>Thời gian còn lại: </h1>
                @endif
                <h1 id="getting-started" style="background-color: while; color: red;"></h1>
                <script type="text/javascript">
                    var tg = "{{ $thoigian }}";
                    $('#getting-started').countdown(tg, function(event) {
                        $(this).html(event.strftime('%H:%M:%S'));
                    }).on('finish.countdown', function() {
                        window.location.replace("/updateTrangThaiSK/");
                    });
                </script>
            </div>
        </div>

        <a class="btn btn-primary" href="/login" role="button">
            <i class="fa fa-lock" aria-hidden="true"></i>
            TRANG QUẢN TRỊ
        </a>
        <hr>

        @if (Session::get('trangthai_sukien') == 2 || Session::get('trangthai_sukien') == 3)
        {{--  Phần quét thẻ điểm danh  --}}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">KHUNG ĐIỂM DANH</h3>
            </div>
            <div class="panel-body">
                <!-- Phần quét thẻ -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                        <h1 class="text-center">Quét thẻ để điểm danh</h1>
                        <form action="" method="post" id="f_quet_the">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="id_the" placeholder="Quét thẻ của bạn" required id="id_the">
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (Session::get('trangthai_sukien') == 4)
            <h1>Hết giờ điểm danh</h1>
            <?php
                \Session::forget('sukien_diemdanh');
            ?>
        @endif
    </div>

    {{--  Script auto size text tiêu đề theo kích thước màn hình  --}}
    <script>
        jQuery("#event_name").fitText(1.5);
    </script>
</body>

</html>