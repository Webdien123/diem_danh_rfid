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
    <script src="{{ asset('js/jquery.fittext.js') }}"></script>
</head>

<body>
    <div id="home_bg"></div>
    <div class="container text-center" id="home_content">
        <h1>Điểm danh vào</h1>
        {{--  <h1>Điểm danh ra</h1>  --}}
        <h2><strong id="event_name" class="text-danger">TUẦN LỄ CHỦ NHẬT XANH VÀ MÙA HÈ XANH LÈ XANH LÉT XANH TÉT BÉT</strong></h2>
        <div class="row">
            <div class="col-xs-12">
                <h2>Thời gian: <b>14:00</b> - Địa điểm: <b>Hội trường rùa</b></h2>
            </div>
        </div>
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
                            <input type="text" class="form-control" name="TuKhoa" placeholder="Quét thẻ của bạn" required id="id_the">
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"tabindex="-1" />
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        
        
        
    </div>

    <script>
        jQuery("#event_name").fitText(1.8);
    </script>
</body>

</html>