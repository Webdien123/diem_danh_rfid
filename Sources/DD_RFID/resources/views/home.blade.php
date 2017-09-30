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
</head>
<body>
    {{--  Thẻ hiển thị ảnh nền  --}}
    <div id="home_bg"></div>

    {{--  Thẻ chứa nội dung trang home  --}}
    <div class="container text-center" id="home_content">

        {{--  Loại điểm danh  --}}
        <h1>Điểm danh vào</h1>
        {{--  <h1>Điểm danh ra</h1>  --}}

        {{--  Tên sự kiện  --}}
        <h2><strong id="event_name" class="text-danger">TUẦN LỄ CHỦ NHẬT XANH VÀ MÙA HÈ XANH NGÁT XANH</strong></h2>

        {{--  Thời gian, địa điểm  --}}
        <div class="row">
            <div class="col-xs-12">
                <h2>Thời gian: <b>14:00</b> - Địa điểm: <b>Hội trường rùa</b></h2>
            </div>
        </div>
        <a class="btn btn-primary" href="/login" role="button">
            <i class="fa fa-lock" aria-hidden="true"></i>
            TRANG QUẢN TRỊ
        </a>
        <hr>

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
                            <input type="text" class="form-control" name="TuKhoa" placeholder="Quét thẻ của bạn" required id="id_the">
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  Script auto size text tiêu đề theo kích thước màn hình  --}}
    <script>
        jQuery("#event_name").fitText(1.8);
    </script>
</body>

</html>